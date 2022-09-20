<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatatestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datatest', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('ram');
            $table->integer('internal');
            $table->integer('baterai');
            $table->float('kam_depan');
            $table->float('kam_belakang');
            $table->integer('harga');
            $table->unsignedBigInteger('kid');
            $table->timestamps();

            $table->foreign('kid')->references('id')->on('kelas')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('datatest');
    }
}
