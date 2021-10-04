<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CatalogoEstadoCivils extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('civils', function (Blueprint $table) {
            $table->id();
            $table->string('civil');
            $table->timestamps();
        });

        DB::table("civils")->insert([
            'civil' => 'Soltero(a)',
        ]);
        DB::table("civils")->insert([
            'civil' => 'Casado(a)',
        ]);
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('civils');
    }
}
