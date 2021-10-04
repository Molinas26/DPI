<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrimendenunciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crimendenuncias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_crimen');
            $table->unsignedBigInteger('id_denuncia');
            $table->foreign('id_crimen')->references('id')->on('crimens')->onDelete('cascade');
            $table->foreign('id_denuncia')->references('id')->on('denuncias')->onDelete('cascade');
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
        Schema::dropIfExists('crimendenuncias');
    }
}
