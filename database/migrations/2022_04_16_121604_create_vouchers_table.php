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
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('code',30)->unique();
            $table->integer('discount');
            $table->integer('quantity');
            $table->tinyInteger('category_code')->comment('loai giam() 0 la %, 1 la price');
            $table->dateTime('active_date')->comment('ngay tao');
            $table->dateTime('expired_date')->comment('ngay het han');
            $table->tinyInteger('status')->default(1);

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
        Schema::dropIfExists('vouchers');
    }
};
