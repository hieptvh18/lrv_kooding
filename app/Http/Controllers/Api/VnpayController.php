<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;


class VnpayController extends Controller
{
    //trang thanh toasn
    public function create(Request $request)
    {
        // chuyen doi sang luu vao cache || cookie de sau khi vnpay handle tra ve data va luu db
        cache(['url_prev' => url()->previous()]);
       
        // dd(session('dataOrders'),session('carts'));->oke
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        // page tra ve khi thanh toan tcong
        $vnp_Returnurl = "http://localhost:8000/return-vnpay";
        $vnp_TmnCode = "DGPENNGZ"; //Mã website tại VNPAY 
        $vnp_HashSecret = "RTYGLRHZQXCRNLROHBLWUJFXSLFQXERD"; //Chuỗi bí mật

        $vnp_TxnRef = uniqid().time(); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = "Thanh toán hóa đơn phí dich vụ";
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = (int)$request->amount * 100;
        $vnp_Locale = 'vn';
        $vnp_IpAddr = request()->ip();

        //Add Params of 2.0.1 Version
   
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        // gui kem order id de xử lí nếu thanh toán k thành công
        $query .= "&orderId=".$request->orderId;

        return redirect($vnp_Url);
    }

    // trả về(kieerm tra tinh toan ven, thanh toan thanh cong hoac that bai)
    public function return(Request $request)
    {

        if ($request->vnp_ResponseCode == "00") {
            // $this->apSer->thanhtoanonline(session('cost_id'));
            return redirect(route('client.result-checkout'))->with('payment-success', 'Đã thanh toán phí dịch vụ');
        }
        // session()->forget('url_prev');

        // that bai thi back ve checkout va update status don chua thanh toan
         // un-save ordered
         $lastedOrder = Order::orderBy('created_at', 'desc')->limit(1)->first();
         Order::destroy($lastedOrder->id);

        return redirect(route('client.result-checkout')."?orderId=".$request->orderId)->with('payment-error', 'Lỗi trong quá trình thanh toán phí dịch vụ');
    }
}
