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
        Schema::create('dia_chi', function (Blueprint $table) {
            $table->id();
            $table->string('tinh_thanh_pho');
            $table->string('quan_huyen');
            $table->string('phuong_xa');
            $table->string('chi_tiet');
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
        Schema::dropIfExists('dia_chi');
    }
};
