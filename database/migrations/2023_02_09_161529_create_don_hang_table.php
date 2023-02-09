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
        Schema::create('don_hang', function (Blueprint $table) {
            $table->id();
            $table->integer('tong_so_luong');
            $table->integer('tong_tien');
            $table->integer('ho_ten');
            $table->integer('id_dia_chi');
            $table->string('so_dien_thoai');
            $table->string('xac_nhan');
            $table->integer('user_id');
            $table->timestamps();
            $table->timestamp('delete_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('don_hang');
    }
};
