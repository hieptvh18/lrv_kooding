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
use App\Models\Cart;
use App\Models\Product;
use App\Models\Stock;
use COM;

class CheckoutController extends Controller
{
    private $carts;
    public function __construct(Request $request)
    {
    }

    // display checkout
    public function index()
    {
        $cartUser = Cart::where('user_id', Auth::user()->id)->count();
        if ($cartUser == 0) {
            return redirect(route('client.home'));
        }

        // get data
        $provinces = Province::all();
        $this->carts = Cart::where('user_id', Auth::user()->id)->get()->toArray();

        return view('client.cart.checkout-save-database', [
            'provinces' => $provinces,
            'carts' => $this->carts,
        ]);
    }

    // handle checkout
    public function postCheckout(Request $request)
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
                if ($voucherExist->quantity == 0) {
                    return back()->with('er-voucher', 'Mã giảm giá đã không còn hiệu lực hõặc đã được dùng hết!');
                }
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

        // ktra method payment & handle save
        return $this->payment($request);
    }

    // check payment = method nao
    private function payment($request)
    {
        switch ($request->method) {
            case "0":
                // tt khi nhan hàng
                $this->carts = Cart::where('user_id', Auth::user()->id)->get()->toArray();

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
                foreach ($this->carts as $item) {
                    $detail_bill = new OrderDetail();
                    $detail_bill->fill($item);
                    $detail_bill->order_id = $bill->id;
                    $detail_bill->price = Product::find($item['product_id'])->first()->price;
                    $detail_bill->save();

                    // giam so luong bien the sp khi dat hang thanh cong
                    Stock::where('pro_id', $item['product_id'])
                        ->where('color_id', $item['color_id'])
                        ->where('size_id', $item['size_id'])
                        ->first()->decrement('quantity', $item['quantity']);
                    
                    Product::find($item['product_id'])->decrement('quantity', $item['quantity']);
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
                    if ($voucherExist->quantity > 0) {
                        $voucherExist->decrement('quantity', 1);
                    }


                    // destroy session
                    session()->pull('codeVoucher');
                    session()->pull('newPrice');
                }

                return redirect()->route('client.result-checkout')->with('payment-success', 'Đặt hàng thành công!');

                break;

            case "1":
                // paypal
                dd('thanh toan bang paypay');
                break;

            default:
                // vnpay
                // vnpay redirect ve se huy toan bo session nen phai truyen data qua request url
                session('codeVoucher') ? $codeVoucher = session('codeVoucher') : null;

                session()->put('dataOrders', $request->all());

                return redirect(route('payment.handleSave'));

                break;
        }
    }

    // handle payment & save db
    public function handlePaymentVnpay(Request $request)
    {
        // save bill to db(total = 0)
        $cartUser = Cart::where('user_id', Auth::user()->id)->get()->toArray();

        $dataOrder = session()->get('dataOrders');
        $province = $dataOrder['tinh'];
        $district = $dataOrder['huyen'];
        $ward = $dataOrder['xa'];

        $bill = new Order();
        $bill->phone = $dataOrder['phone'];
        $bill->user_id = Auth::user()->id;
        $bill->name = $dataOrder['fullname'];

        $bill->address = Ward::where('wardid', "$ward")->first()->name . '-' . District::where('districtid', "$district")->first()->name  . '-' . Province::where('provinceid', "$province")->first()->name  . ', ' . $dataOrder['address'];
        $bill->payment = "Đã thanh toán bằng ví Vnpay";
        $bill->total_price = 0;
        $bill->status = 0;
        if (session('codeVoucher')) {
            $bill->code_voucher = session()->pull('codeVoucher');
            session()->pull('newPrice');
        }
        $bill->save();

        // loop data & save to order detail
        foreach ($cartUser as $item) {
            $detail_bill = new OrderDetail();
            $detail_bill->fill($item);
            $detail_bill->order_id = $bill->id;
            $detail_bill->price = Product::find($item['id'])->price;
            $detail_bill->save();
        }

        return redirect(route('api.payment.vnpay') . "?amount=" . $dataOrder['total'] . "&orderId=" . $bill->id);
    }

    // display client.result-checkout
    public function resultCheckout(Request $request)
    {
        // dd($request->all());

        // thanh toan thanh cong
        // destroy cart
        Cart::where('user_id', Auth::user()->id)->delete();

        if (session()->has('payment-success')) {

            // ...
            return view('client.pages.result-checkout');
        } else if (session()->has('payment-error')) {

            // thanh toan that bai
            $urlPrev = cache('url_prev');

            // un-save ordered
            $lastedOrder = Order::orderBy('created_at', 'desc')->limit(1)->first();
            Order::destroy($lastedOrder->id);

            return redirect($urlPrev)->with('msg-er', 'Lỗi trong quá trình thanh toán phí dịch vụ');
        }
        return view('client.pages.result-checkout');
    }
}
