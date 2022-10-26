<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUjiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uji', function (Blueprint $table) {
            // $table->id();
            $table->id();
            $table->string('name');
            $table->integer('ram');
            $table->integer('internal');
            $table->integer('baterai');
            $table->float('kam_depan');
            $table->float('kam_belakang');
            $table->integer('harga');
            $table->unsignedBigInteger('kid');
            $table->unsignedBigInteger('klasifikasi')->nullable();
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
        Schema::dropIfExists('uji');
    }
}
