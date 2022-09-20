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
            $table->float('testram');
            $table->integer('testinternal');
            $table->float('testbaterai');
            $table->float('testkam_depan');
            $table->float('testkam_belakang');
            $table->float('testharga');
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
