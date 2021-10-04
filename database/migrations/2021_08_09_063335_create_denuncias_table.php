<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDenunciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('denuncias', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->unsignedBigInteger('id_agente');
            $table->unsignedBigInteger('id_denunciante');
            $table->unsignedBigInteger('id_sospechoso');
            $table->unsignedBigInteger('id_ofendido');
            $table->dateTime('fecha_denuncia');
            $table->dateTime('fecha_alternativa')->nullable();
            $table->string('tomador_denuncia');
            $table->integer('dias')->default(30);
            $table->integer('remitida')->default(0)->nullable();
            $table->integer('pausado')->default(0)->nullable();
            $table->dateTime('fecha_remitido')->nullable();
            $table->unsignedBigInteger('accion')->default(1);
            $table->foreign('id_agente')->references('id')->on('agentes')->onDelete('cascade');
            $table->foreign('id_denunciante')->references('id')->on('denunciantes')->onDelete('cascade');
            $table->foreign('id_sospechoso')->references('id')->on('sospechosos')->onDelete('cascade');
            $table->foreign('id_ofendido')->references('id')->on('ofendidos')->onDelete('cascade');
            $table->foreign('accion')->references('id')->on('catalogo_accions')->onDelete('cascade');
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
        Schema::dropIfExists('denuncias');
    }
}
