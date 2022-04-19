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

        // roles user
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

        // account
        DB::table('users')->insert([
            [
                "name"=>"hiep hoang tran",
            "email"=>"hieptvh18@gmail.com",
            "phone"=>"0123144444",
            "role_id"=>3,
            "password"=>bcrypt("123123")
            ],
            [
                "name"=>"toi la khach hang",
            "email"=>"hipbu18@gmail.com",
            "phone"=>"0123144442",
            "role_id"=>1,
            "password"=>bcrypt("123123")
            ]
        ]);

        // attribute
        DB::table('attributes')->insert([
            [
                "name"=>"Màu sắc"
            ],
            [
                "name"=>"Kích cỡ"
            ],
            ["name"=>"Chất liệu"]
        ]);

        // attr value
        DB::table('attr_values')->insert([
            ["attr_id"=>1,
            "name"=>"Đỏ cam",
            "value"=>"#ff0000"],
            ["attr_id"=>2,
            "name"=>"Medium",
            "value"=>"M"],
            ["attr_id"=>3,
            "name"=>"Vải gấm",
            "value"=>"Vải gấm"],
        ]);

        // brand+ product
        \App\Models\Brand::factory(5)->create();
        \App\Models\Category::factory(5)->create();
        \App\Models\Product::factory(15)->create();
    }
}
