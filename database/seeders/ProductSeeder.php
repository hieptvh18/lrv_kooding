<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Str;

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
    //    Product::insert([
    //         ['name'=>Str::random(7),
    //         "slug"=>"ao-nay-dep",
    //         "sub_category_id"=>1,
    //         "price"=>12000,
    //         "discount"=>1000,
    //         "brand"=>'China',
    //         "avatar"=>'images',
    //         "description"=>'hihi',
    //         "quantity"=>20,
    //         "status"=>1,
    //         "view"=>1],
    //         [
    //             'name'=>Str::random(7),
    //         "slug"=>"ao-nay-xau4",
    //         "sub_category_id"=>1,
    //         "price"=>12000,
    //         "discount"=>1000,
    //         "brand"=>'Vietnam',
    //         "avatar"=>'images',
    //         "description"=>'hihi',
    //         "quantity"=>20,
    //         "status"=>1,
    //         "view"=>1,
    //         ],
    //         [
    //             'name'=>"ao xinh",
    //         "slug"=>"ao-nay-xau3",
    //         "sub_category_id"=>1,
    //         "price"=>12000,
    //         "discount"=>1000,
    //         "brand"=>'Thailand',
    //         "avatar"=>'images',
    //         "description"=>'hihi',
    //         "quantity"=>20,
    //         "status"=>1,
    //         "view"=>1,
    //         ],
    //         [
    //             'name'=>"ao dep hihi",
    //         "slug"=>"ao-nay-xau2",
    //         "sub_category_id"=>1,
    //         "price"=>12000,
    //         "discount"=>1000,
    //         "brand"=>'Vietnam',
    //         "avatar"=>'images',
    //         "description"=>'hihi',
    //         "quantity"=>20,
    //         "status"=>1,
    //         "view"=>1,
    //         ],
    //         [
    //             'name'=>"ao xau 2",
    //         "slug"=>"ao-nay-xau1",
    //         "sub_category_id"=>1,
    //         "price"=>12000,
    //         "discount"=>1000,
    //         "brand"=>'Vietnam',
    //         "avatar"=>'images',
    //         "description"=>'hihi',
    //         "quantity"=>20,
    //         "status"=>1,
    //         "view"=>1,
    //         ]

    //     ]);

        // de run data thi go: php artisan db:seed --class=ProductSeeder
    }
}
