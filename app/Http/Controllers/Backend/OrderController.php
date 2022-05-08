<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Models\Product;

use App\Exports\OrdersExport;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
{
    // list order
    public function index(Request $request)
    {
        $type = 'desc';
        $orders = Order::select('*');
        $title = null;

        // sort name
        if ($request->_sort) {
            if ($request->type == 'asc') {
                $orders = $orders->orderBy($request->column, $request->type);
                $type = 'desc';
            } else {
                $orders = $orders->orderBy($request->column, $request->type);
                $type = 'asc';
            }
        }else{
            $orders = $orders->orderBy('id',$type);
        }

        // search
        if($request->keyword){
            $orders= $orders->where('id',$request->keyword);
            if($orders->count() == 0){
                $title = 'Không tìm thấy đơn hàng';
            }else{
                $title = 'Kết quả tìm kiếm';

            }
        }

        $orders = $orders->paginate(20);
        return view('admin.order.list', compact('orders','type','title'));
    }

    // detail
    public function orderDetail($id)
    {
        // get data
        $receiver = Order::find($id);
        $bill = OrderDetail::where('order_id',$id)->get();

        return view('admin.order.detail',compact('receiver','bill'));
    }

    // change status
    public function changeStatus($id, Request $request)
    {
        // status: 0 la chua xac nhan, 1 la dang xu li, 2 la da xu li, 3 la huy don(hoan lai qty san pham da tru luc dat hang)
        $order = Order::find($id);
        $order->status = $request->status;
        $order->save();

        if($request->status == 3){

            $bill = OrderDetail::where('order_id',$id)->get();
            foreach($bill as $item){
                Product::find($item->product_id)->increment('quantity',$item->quantity);
            }
        }

        return redirect(route('admin.order.detail',$id))->with('msg-suc','Cập nhật thành công tình trạng đơn hàng!');
    }


    // export file 
    public function export() 
    {
        return Excel::download(new OrdersExport(), 'donhang-kooding.xlsx');
    }

}
