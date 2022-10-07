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
            $table->id();
            //$table->string('ujiname');
            $table->float('nram');
            $table->float('nbaterai');
            $table->float('ninternal');
            $table->float('nkam_depan');
            $table->float('nkam_belakang');
            $table->float('nharga')->nullable();
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
