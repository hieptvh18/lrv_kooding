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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();

            $table->foreignId('pro_id');
            $table->foreign('pro_id')->references('id')->on('products')->onDelete('cascade');
            $table->string('name',200);
            $table->foreignId('color_id');
            $table->foreign('color_id')->references('id')->on('attr_values')->onDelete('cascade');

            $table->foreignId('size_id');
            $table->foreign('size_id')->references('id')->on('attr_values')->onDelete('cascade');

            $table->foreignId('material_id');
            $table->foreign('material_id')->references('id')->on('attr_values')->onDelete('cascade');

            // mã định danh
            $table->string('sku',100)->unique();
            // slg san pham luc nhap kho
            $table->integer('quantity')->comment('so luong cua tung san pham va thuoc tinh tuong ung');

            // slg sp da ban
            
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
        Schema::dropIfExists('stocks');
    }
};
