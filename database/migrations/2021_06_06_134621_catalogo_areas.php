<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CatalogoAreas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('areas', function (Blueprint $table) {
            $table->id();
            $table->string('area');
            $table->timestamps();
        });
        
        
        DB::table("areas")->insert([
            'area' => 'Delitos Comunes',
        ]);
        DB::table("areas")->insert([
            'area' => 'Delitos contra la Propiedad',
        ]);
        DB::table("areas")->insert([
            'area' => 'Delitos contra la Vida',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('areas');
    }
}
