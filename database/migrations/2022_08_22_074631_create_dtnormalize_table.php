<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDtnormalizeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dtnormalize', function (Blueprint $table) {
            $table->id('pid');
            // $table->float('testname');
            $table->float('nram');
            $table->integer('ninternal');
            $table->float('nbaterai');
            $table->float('nkam_depan');
            $table->float('nkam_belakang');
            $table->float('nharga');
            // $table->float('testklasifikasi');
            $table->timestamps();

            // $table->foreign('pid')->references('id')->on('datatest')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dtnormalize');
    }
}
