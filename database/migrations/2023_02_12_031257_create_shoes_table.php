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
        Schema::create('shoes', function (Blueprint $table) {
            $table->id();
            $table->timestamp('email_verified_at')->nullable();
            $table->integer('id_prod_sale');
            $table->string('name');
            $table->string('img');
            $table->string('description');
            $table->integer('id_type');
            $table->string('list_variant');
            $table->integer('price');
            $table->integer('sale_price');
            $table->integer('time_end_sale');
            $table->integer('time_start_sale');
            $table->softDeletes()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shoes');
    }
};
