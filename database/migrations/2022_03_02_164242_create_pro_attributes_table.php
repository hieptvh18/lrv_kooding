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
        Schema::create('pro_attributes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pro_id');
            $table->foreignId('attr_id');
            $table->foreignId('value_id');
            
            $table->foreign('pro_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('attr_id')->references('id')->on('attributes')->onDelete('cascade');
            $table->foreign('value_id')->references('id')->on('attr_values')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pro_attributes');
    }
};
