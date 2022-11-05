<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUjinormTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ujinorm', function (Blueprint $table) {
            $table->id();
            $table->string('nname');
            $table->float('nram');
            $table->float('nbaterai');
            $table->float('ninternal');
            $table->float('nkam_depan');
            $table->float('nkam_belakang');
            $table->integer('nharga')->nullable();
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
        Schema::dropIfExists('ujinorm');
    }
}
