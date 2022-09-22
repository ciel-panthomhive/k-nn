<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDunormalizeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dunormalize', function (Blueprint $table) {
            $table->id('pid_u');
            //$table->string('ujiname');
            $table->integer('nram');
            $table->integer('nbaterai');
            $table->integer('ninternal');
            $table->float('nkam_depan');
            $table->float('nkam_belakang');
            $table->integer('nharga');
            // $table->string('nklasifikasi');
            $table->timestamps();

            // $table->foreign('pid_u')->references('id')->on('datauji')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dunormalize');
    }
}
