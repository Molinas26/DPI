<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDenunciantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('denunciantes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nacionalidad');
            $table->string('DNI');
            $table->integer('edad');
            $table->unsignedBigInteger('estado_civil');
            $table->string('nombre')->nullable();
            $table->foreign('estado_civil')
                ->references('id')
                ->on('civils')
                ->onDelete('cascade');
            $table->foreign('nacionalidad')
                ->references('id')
                ->on('nacionalidads')
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
        Schema::dropIfExists('denunciantes');
    }
}
