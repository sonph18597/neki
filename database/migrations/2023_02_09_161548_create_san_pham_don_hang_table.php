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
        Schema::create('san_pham_don_hang', function (Blueprint $table) {
            $table->id();
            $table->integer('id_don_hang');
            $table->integer('id_san_pham');
            $table->integer('so_luong');
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
        Schema::dropIfExists('san_pham_don_hang');
    }
};
