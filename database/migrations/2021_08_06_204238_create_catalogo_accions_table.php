<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatalogoAccionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalogo_accions', function (Blueprint $table) {
            $table->id();
            $table->string('accion');
            $table->timestamps();
        });


        DB::table("catalogo_accions")->insert([
            'accion' => 'No Asignada',
        ]);
        DB::table("catalogo_accions")->insert([
            'accion' => 'Orden de captura',
        ]);
        DB::table("catalogo_accions")->insert([
            'accion' => 'Detención preventiva',
        ]);
        DB::table("catalogo_accions")->insert([
            'accion' => 'Flagrancia',
        ]);
    }


        /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('catalogo_accions');
    }
}
