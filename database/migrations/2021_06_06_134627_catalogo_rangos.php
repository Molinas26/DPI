<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CatalogoRangos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rangos', function (Blueprint $table) {
            $table->id();
            $table->string('rango');
            $table->timestamps();
        });

        DB::table("rangos")->insert([
            'rango' => 'Clase I de Policía',
        ]);
        DB::table("rangos")->insert([
            'rango' => 'Agente de Policía',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rangos');
    }
}
