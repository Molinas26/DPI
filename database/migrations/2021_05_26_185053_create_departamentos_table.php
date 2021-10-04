<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departamentos', function (Blueprint $table) {
            $table->id();
            $table->string('nombredepartamento');
            $table->timestamps();
        });

        DB::table("departamentos")->insert([
            'nombredepartamento' => 'Atlántida',      
        ]);
        DB::table("departamentos")->insert([
            'nombredepartamento' => 'Colón',      
        ]);
        DB::table("departamentos")->insert([
            'nombredepartamento' => 'Comayagua',      
        ]);
        DB::table("departamentos")->insert([
            'nombredepartamento' => 'Copán',      
        ]);
        DB::table("departamentos")->insert([
            'nombredepartamento' => 'Cortés',      
        ]);
        DB::table("departamentos")->insert([
            'nombredepartamento' => 'Choluteca',      
        ]);
        DB::table("departamentos")->insert([
            'nombredepartamento' => 'El Paraíso',      
        ]);
        DB::table("departamentos")->insert([
            'nombredepartamento' => 'Francisco Morazán',      
        ]);
        DB::table("departamentos")->insert([
            'nombredepartamento' => 'Gracias a Dios',      
        ]);
        DB::table("departamentos")->insert([
            'nombredepartamento' => 'Intibucá',      
        ]);
        DB::table("departamentos")->insert([
            'nombredepartamento' => 'Islas de La Bahía',      
        ]);
        DB::table("departamentos")->insert([
            'nombredepartamento' => 'La Paz',      
        ]);
        DB::table("departamentos")->insert([
            'nombredepartamento' => 'Lempira',      
        ]);
        DB::table("departamentos")->insert([
            'nombredepartamento' => 'Ocotepeque',      
        ]);
        DB::table("departamentos")->insert([
            'nombredepartamento' => 'Olancho',      
        ]);
        DB::table("departamentos")->insert([
            'nombredepartamento' => 'Santa Bárbara',      
        ]);
        DB::table("departamentos")->insert([
            'nombredepartamento' => 'Valle',      
        ]);
        DB::table("departamentos")->insert([
            'nombredepartamento' => 'Yoro',      
        ]);

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('departamentos');
    }
}
