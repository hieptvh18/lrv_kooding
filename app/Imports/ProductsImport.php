<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Product([
            //
            "name"=>$row[0],
            "slug"=>$row[1],
            "category_id"=>$row[2],
            "price"=>$row[3],
            "discount"=>$row[4],
            "brand_id"=>$row[5],
            'description'=>$row[6],
        ]);
    }
}
