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
        Schema::create('discount_code', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('discount_code');
            $table->string('exclude_prod');
            $table->string('include_prod');
            $table->string('condition_type');
            $table->string('type_discount');
            $table->integer('discount_number');
            $table->integer('limits');
            $table->integer('time_start');
            $table->integer('time_end');
            $table->timestamps('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discount_code');
    }
};
