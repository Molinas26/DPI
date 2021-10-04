<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSospechososTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sospechosos', function (Blueprint $table) {
            $table->id();
            $table->dateTime('fecha_inicio');
            $table->string('caracteristica')->nullable();
            $table->unsignedBigInteger('departamento_sospechoso');
            $table->unsignedBigInteger('municipio_sospechoso');
            $table->string('sector_sospechoso');
            $table->foreign('departamento_sospechoso')
                ->references('id')
                ->on('departamentos')
                ->onDelete('cascade');
            $table->foreign('municipio_sospechoso')
                ->references('id')
                ->on('municipios')
                ->onDelete('cascade');
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
        Schema::dropIfExists('sospechosos');
    }
}
