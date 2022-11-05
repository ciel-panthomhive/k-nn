<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarinormTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carinorm', function (Blueprint $table) {
            $table->id();
            //$table->string('ujiname');
            $table->float('nram')->nullable();
            $table->float('nbaterai')->nullable();
            $table->float('ninternal')->nullable();
            $table->float('nkam_depan')->nullable();
            $table->float('nkam_belakang')->nullable();
            $table->integer('nharga')->nullable();
            $table->float('nklas')->nullable();
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
        Schema::dropIfExists('carinorm');
    }
}
