<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id('id');
            $table->string('name',300);
            $table->string('slug',300)->unique();

            $table->foreignId('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            
            $table->integer('price');
            $table->integer('discount')->comment('gia giam')->nullable(0);
            
            $table->foreignId('brand_id');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');

            $table->string('avatar',355);
            $table->longText('description');
            $table->integer('quantity')->comment('save to stock');
            $table->tinyInteger('status')->comment('tinh trang cua san pham')->nullable(1);
            $table->bigInteger('view')->nullable(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
