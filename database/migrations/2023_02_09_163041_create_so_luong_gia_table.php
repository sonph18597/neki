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
        Schema::create('so_luong_gia', function (Blueprint $table) {
            $table->id();
            $table->integer("id_mau");
            $table->integer("id_size");
            $table->integer('so_luong');
            $table->float('gia');
            $table->string('anh')->nullable();
            $table->timestamp("delete_at")->nullable();
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
        Schema::dropIfExists('so_luong_gia');
    }
};
