<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $products = Product::select('products.id','products.name','products.slug','categories.name as category_name','products.price','products.discount','brands.name as brand_name','products.description','products.quantity','products.status','products.view','products.created_at','products.updated_at')
                        ->leftJoin('categories','categories.id','products.category_id')
                        ->leftJoin('brands','brands.id','products.brand_id')
                        ->orderBy('id','desc')
                        ->get();
        return $products;
    }

      /**
     * Set header columns
     *
     * @return array
     */
    public function headings() :array
    {
        return [
            'ID',
            'Tên',
            'slug',
            'Danh mục',
            'Giá',
            'Giảm giá',
            'Thương hiệu',
            'Mô tả',
            'Số lượng',
            'Tình trạng',
            'Lượt xem',
            'Ngày nhập',
            'Ngày cập nhật'
        ];
    }
}
