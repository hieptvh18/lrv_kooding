<?php

namespace Database\Seeders;

use Attribute;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


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
        $this->call([
            // ProductSeeder::class,
            // BrandSeeder::class
            // AttributeSeeder::class
        ]);
        \App\Models\Brand::factory(2)->create();
        \App\Models\Category::factory(2)->create();
        \App\Models\Product::factory(11)->create();
    }
}
