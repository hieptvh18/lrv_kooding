<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //
            'name'=>$this->faker->name(),
            "slug"=>Str::slug($this->faker->name()),
            "category_id"=>1,
            "price"=>$this->faker->numerify(),
            "discount"=>1000,
            "brand_id"=>1,
            "avatar"=>$this->faker->image(),
            "description"=>$this->faker->text(),
            "quantity"=>20,
            "status"=>1,
            "view"=>1
        ];
    }
}
