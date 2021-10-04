<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfendidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ofendidos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nacionalidad_ofendido');
            $table->string('DNI_ofendido');
            $table->string('telefono_ofendido');
            $table->string('nombre_ofendido')->nullable();
            $table->unsignedBigInteger('departamento_ofendido');
            $table->unsignedBigInteger('municipio_ofendido');
            $table->string('sector_ofendido');
            $table->foreign('nacionalidad_ofendido')
                ->references('id')
                ->on('nacionalidads')
                ->onDelete('cascade');
            $table->foreign('departamento_ofendido')
                ->references('id')
                ->on('departamentos')
                ->onDelete('cascade');
            $table->foreign('municipio_ofendido')
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
        Schema::dropIfExists('ofendidos');
    }
}
