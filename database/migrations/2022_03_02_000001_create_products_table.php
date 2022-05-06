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
            $table->string('name',300)->unique();
            $table->string('slug',300)->unique();

            $table->foreignId('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            
            $table->integer('price');
            $table->integer('discount')->nullable()->default(0)->comment('gia giam');
            
            $table->foreignId('brand_id');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');

            $table->string('avatar',355)->nullable();
            $table->string('description',500);
            // note :quantity se la tong so luong cua bien the sp trong stock + lai
            $table->integer('quantity')->comment('save to stock')->nullable()->default(0);
            $table->tinyInteger('status')->nullable()->default(0)->comment('tinh trang cua san pham');
            $table->bigInteger('view')->nullable()->default(0);
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
