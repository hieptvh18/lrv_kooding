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
        Schema::create('cate_attributes', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('cate_id');
            $table->foreign('cate_id')->references('id')->on('sub_categories')->onDelete('cascade');

            $table->foreignId('attr_id');
            $table->foreign('attr_id')->references('id')->on('attributes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cate_attributes');
    }
};
