<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataujiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datauji', function (Blueprint $table) {
            $table->id();
            //$table->string('nameu');
            $table->integer('ram_u');
            $table->integer('internal_u');
            $table->integer('baterai_u');
            $table->float('kam_depan_u');
            $table->float('kam_belakang_u');
            // $table->integer('harga_u');
            // $table->integer('harga_max_u');
            $table->unsignedBigInteger('kid_u')->nullable();
            $table->timestamps();

            // $table->foreign('kid_u')->references('id')->on('kelas')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('datauji');
    }
}
