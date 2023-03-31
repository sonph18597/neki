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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('ten');
            $table->string('so_dien_thoai')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string("email")->unique();
            $table->string('password')->nullable();
            $table->integer('id_dia_chi')->default(1);
            $table->integer('role_id')->default(1);
            $table->integer('gioi_tinh')->default(1);
            $table->string("anh")->nullable();
            $table->date("ngay_sinh")->nullable();
            $table->integer('trang_thai')->default(1);
            $table->rememberToken();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
