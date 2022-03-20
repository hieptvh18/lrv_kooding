<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
       Product::insert([
            'name'=>"ao xau",
            "slug"=>"ao-nay-xau",
            "sub_category_id"=>1,
            "price"=>12000,
            "discount"=>1000,
            "brand"=>'Vietnam',
            "avatar"=>'images',
            "description"=>'hihi',
            "quantity"=>20,
            "status"=>1,
            "view"=>1,

        ]);

        // de run data thi go: php artisan db:seed --class=ProductSeeder
    }
}
