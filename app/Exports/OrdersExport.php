<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class OrdersExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $orders = Order::select('orders.id','users.email','orders.phone','orders.name','orders.total_price','orders.address','orders.payment','orders.code_voucher','orders.status','orders.note','orders.created_at','orders.updated_at')
        ->join('users','users.id','orders.user_id')
        ->get();

        return $orders;
    }

    /**
     * Set header columns
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID ',
            'Email người gửi',
            'Điện thoại',
            'Tên người nhận',
            'Tổng tiền',
            'Địa chỉ',
            'Thanh toán',
            'Mã giảm giá',
            'Tình trạng',
            'Ghi chú',
            'Ngày tạo',
            'Ngày cập nhật',

        ];
    }

    /**
     * Mapping data
     *
     * @return array
     */
    // public function map($bill): array
    // {
    //     return [
    //         $orders->id,
    //         $orders->name,
    //     ];
    // }
}
