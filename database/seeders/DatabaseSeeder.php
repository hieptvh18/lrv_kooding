<?php

namespace Database\Seeders;

use Attribute;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // seeder
        DB::table('roles')->insert([
            [
                "name"=>"Khách hàng",
                "created_at"=> Carbon::now()->toDateTimeString(),
                "updated_at"=> Carbon::now()->toDateTimeString()
            ],
            [
                "name"=>"Nhân viên",
                "created_at"=> Carbon::now()->toDateTimeString(),
                "updated_at"=> Carbon::now()->toDateTimeString()

            ],
            [
                "name"=>"Quản lý",
                "created_at"=> Carbon::now()->toDateTimeString(),
                "updated_at"=> Carbon::now()->toDateTimeString()

            ]
        ]);
        


        // DB::table('attributes')->insert([
        //     [
        //         "name"=>"Màu sắc"
        //     ],
        //     [
        //         "name"=>"Kích cỡ"
        //     ],
        //     ["name"=>"Chất liệu"]
        // ]);
        // DB::table('attr_values')->insert([
        //     ["attr_id"=>1,
        //     "name"=>"Đỏ cam",
        //     "value"=>"#ff0000"],
        //     ["attr_id"=>2,
        //     "name"=>"Medium",
        //     "value"=>"M"],
        //     ["attr_id"=>3,
        //     "name"=>"Vải gấm",
        //     "value"=>"Vải gấm"],
        // ]);

        // \App\Models\Brand::factory(5)->create();
        // \App\Models\Category::factory(5)->create();
        // \App\Models\Product::factory(15)->create();
    }
}
