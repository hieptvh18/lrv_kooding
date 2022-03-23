<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Attribute;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Attribute::create([
            [
                "name"=>"Màu sắc"
            ],
            [
                "name"=>"Kích cỡ"
            ]
            ]);
    }
}
