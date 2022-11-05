<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePencarianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pencarian', function (Blueprint $table) {
            $table->id();
            //$table->string('nameu');
            $table->integer('ram_u')->nullable();
            $table->integer('internal_u')->nullable();
            $table->integer('baterai_u')->nullable();
            $table->float('kam_depan_u')->nullable();
            $table->float('kam_belakang_u')->nullable();
            $table->integer('harga_u')->nullable();
            // $table->integer('harga_max_u');
            $table->unsignedBigInteger('kid_u')->nullable();
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
        Schema::dropIfExists('pencarian');
    }
}
