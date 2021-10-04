<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CatalogoNacionalidad extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nacionalidads', function (Blueprint $table) {
            $table->id();
            $table->string('nacionalidad');
            $table->timestamps();
        });

        DB::table("nacionalidads")->insert([
            'nacionalidad' => 'Honduraña',
        ]);
        DB::table("nacionalidads")->insert([
            'nacionalidad' => 'Extranjera',
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::dropIfExists('nacionalidads');
    }
}
