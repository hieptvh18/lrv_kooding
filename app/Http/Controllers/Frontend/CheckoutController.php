<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\Voucher;
use App\Models\VoucherUser;
use App\Models\District;
use App\Models\Ward;
use App\Models\PaymentVnPay;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function __construct(Request $request)
    {
        // reset voucher
        if (session()->has('newPrice')) {
            session()->pull('newPrice');
            session()->pull('codeVoucher');
        }
    }

    // display checkout
    public function index()
    {

        if (!session('carts') || count(session('carts')) == 0) {
            return redirect(route('client.home'));
        }

        // get data
        $provinces = Province::all();


        return view('client.cart.checkout', compact('provinces'));
    }

    // handle checkout
    public function handleCheckout(Request $request)
    {
        // ktra voucher
        if ($request->btn_apply_voucher) {
            $voucherExist = Voucher::where('code', "$request->code")
                ->where('status', '!=', 0)->first();
            if ($voucherExist) {

                // check slg con lai voi da su dung VOucherUser chua
                $voucherUser = VoucherUser::where('user_id', Auth::user()->id)
                    ->where('voucher_id', "$voucherExist->id")->first();

                if ($voucherUser) {
                    return back()->with('er-voucher', 'Bạn đã sử dụng voucher rồi!');
                }

                // handle giảm
                $total = (int)$request->total;
                if ($voucherExist->category_code == 0) {
                    // %
                    $newPrice = round($total * ((100 -  $voucherExist->discount) / 100));

                    // luu session tam thoi
                    session()->put('newPrice', $newPrice);
                } else {
                    // vnd
                    $newPrice = $total - $voucherExist->discount;
                    $newPrice < 0 ? $newPrice = 0 : $newPrice;
                    session()->put('newPrice', $newPrice);
                }

                session()->put('codeVoucher', $voucherExist->code);
                return back();
            } else {
                return back()->with('er-voucher', 'Mã không chính xác!');
            }
        }

        // check used voucher
        if (session('codeVoucher')) {
            // luu tt vo voucherUser
            $voucherExist = Voucher::where('code', session('codeVoucher'))->first();
            VoucherUser::create([
                "user_id" => Auth::user()->id,
                "voucher_id" => $voucherExist->id,
            ]);

            // decrement qty voucher
            $voucherExist->decrement('quantity', 1);
        }

        // ktra method payment & handle save
        return $this->payment($request);
    }

    // check payment
    private function payment($request)
    {
        switch ($request->method) {
            case "0":
                // tt khi nhan hàng
                $bill = new Order();
                $bill->phone = $request->phone;
                $bill->user_id = Auth::user()->id;
                $bill->name = $request->fullname;
                $bill->address = Ward::where('wardid', "$request->xa")->first()->name . '-' . District::where('districtid', "$request->huyen")->first()->name  . '-' . Province::where('provinceid', "$request->tinh")->first()->name  . ', ' . $request->address;
                $bill->payment = "Thanh toán khi nhận hàng";
                $bill->total_price = $request->total;
                $bill->status = 0;
                if (session('codeVoucher')) {
                    $bill->code_voucher = session('codeVoucher');
                }
                $bill->save();

                // loop data & save to order detail
                foreach (session('carts') as $item) {
                    $detail_bill = new OrderDetail();
                    $detail_bill->fill($item);
                    $detail_bill->order_id = $bill->id;
                    $detail_bill->save();
                }

                // destroy session

                session()->pull('newPrice');
                session()->pull('codeVoucher');

                return redirect()->route('client.result-checkout')->with('msg-suc', 'Đặt hàng thành công!');

                break;

            case "1":
                // paypal
                dd('thanh toan bang paypay');
                break;

            default:
                // vnpay
                // luu data vao session de ti thanh toan thanh cong thi save db bang session do-> save xong thi huy
                session()->put('dataOrders',$request->all());
                return redirect(route('api.payment.vnpay') . "?amount=$request->total");

                break;
        }
    }

    // handle payment & save db
    public function handlePaymentVnpay(Request $request)
    {

        // save bill to db(total = 0)
        // $payment_vnpay = new PaymentVnPay();

        // $payment_vnpay->fill($request->all());
        // $payment_vnpay->save();

        $dataOrder = session('dataOrders');
        $province = $dataOrder['tinh'];
        $district = $dataOrder['huyen'];
        $ward = $dataOrder['xa'];

        $bill = new Order();
        $bill->phone = $dataOrder['phone'];
        $bill->user_id = Auth::user()->id;
        $bill->name = $dataOrder['fullname'];

        $bill->address = Ward::where('wardid', "$ward")->first()->name . '-' . District::where('districtid', "$district")->first()->name  . '-' . Province::where('provinceid', "$province")->first()->name  . ', ' . $dataOrder['address'];

        $bill->payment = "Thanh toán qua ví Vnpay";
        $bill->total_price = 0;
        $bill->status = 0;
        if (session('codeVoucher')) {
            $bill->code_voucher = session('codeVoucher');
        }
        $bill->save();

        // loop data & save to order detail
        foreach (session('carts') as $item) {
            $detail_bill = new OrderDetail();
            $detail_bill->fill($item);
            $detail_bill->order_id = $bill->id;
            $detail_bill->save();
        }


        // destroy session
        session()->pull('newPrice');
        session()->pull('codeVoucher');
        session()->pull('dataOrders');

        return redirect()->route('client.result-checkout')->with('msg-suc', 'Đặt hàng thành công!');


    }

    // display client.result-checkout
    public function resultCheckout()
    {
        session()->pull('carts');

        return view('client.pages.result-checkout');
    }
}