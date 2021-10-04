<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use NunoMaduro\Collision\Adapters\Phpunit\State;

class CreateAgentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agentes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('area');
            $table->string('placa');
            $table->unsignedBigInteger('rango');
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('telefono');
            $table->integer('delitos')->default(0);;
            $table->boolean('estado')->default(true);
            $table->boolean('vacaciones')->default(false);
            $table->foreign('area')
                ->references('id')
                ->on('areas')
                ->onDelete('cascade');
            $table->foreign('rango')
                ->references('id')
                ->on('rangos')
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
        Schema::dropIfExists('agentes');
    }
}
