<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Str;

class ProductsImport implements ToModel, WithStartRow
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
            "name" => $row[0],
            "category_id" => $row[1],
            'slug' => Str::slug($row[0]),
            "price" => $row[2],
            "discount" => $row[3],
            "brand_id" => $row[4],
            'description' => $row[5],
        ]);
    }

    // import data bat dau tu hang
    public function startRow(): int
    {
        return 2;
    }
}
