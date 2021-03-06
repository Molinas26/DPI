<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMunicipiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('municipios', function (Blueprint $table) {
            $table->id();
            $table->integer('codigo');
            $table->string('nombremunicipio');
            $table->unsignedBigInteger('departamento');
            $table->foreign('departamento')
            ->references('id')
            ->on('departamentos')
            ->onDelete('cascade');
            $table->timestamps();
        });

        DB::table("municipios")->insert([
            'codigo' => 1, 
            'nombremunicipio' => 'El Porvenir',      
            'departamento' => 1,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 2, 
            'nombremunicipio' => 'La Ceiba',      
            'departamento' => 1,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 3, 
            'nombremunicipio' => 'Esparta',      
            'departamento' => 1,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 4, 
            'nombremunicipio' => 'Jutiapa',      
            'departamento' => 1,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 5, 
            'nombremunicipio' => 'La Masica',      
            'departamento' => 1,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 6, 
            'nombremunicipio' => 'San Francisco',      
            'departamento' => 1,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 7, 
            'nombremunicipio' => 'Tela',      
            'departamento' => 1,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 8, 
            'nombremunicipio' => 'Arizona',      
            'departamento' => 1,  
        ]);

//colon
        DB::table("municipios")->insert([
            'codigo' => 1, 
            'nombremunicipio' => 'Trujillo',      
            'departamento' => 2,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 2, 
            'nombremunicipio' => 'Balfate',      
            'departamento' => 2,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 3, 
            'nombremunicipio' => 'Iriona',      
            'departamento' => 2,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 4, 
            'nombremunicipio' => 'Lim??n',      
            'departamento' => 2,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 5, 
            'nombremunicipio' => 'Sab??',      
            'departamento' => 2,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 6, 
            'nombremunicipio' => 'Santa Fe',      
            'departamento' => 2,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 7, 
            'nombremunicipio' => 'Santa Rosa de Agu??n',      
            'departamento' => 2,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 8, 
            'nombremunicipio' => 'Sonaguera',      
            'departamento' => 2,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 9, 
            'nombremunicipio' => 'Tocoa',      
            'departamento' => 2,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 10, 
            'nombremunicipio' => 'Bonito Oriental',      
            'departamento' => 2,  
        ]);

        //comayagua
        DB::table("municipios")->insert([
            'codigo' => 1, 
            'nombremunicipio' => 'Comayagua',      
            'departamento' => 3,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 2, 
            'nombremunicipio' => 'Ajuterique',      
            'departamento' => 3,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 3, 
            'nombremunicipio' => 'El Rosario',      
            'departamento' => 3,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 4, 
            'nombremunicipio' => 'Esqu??as',      
            'departamento' => 3,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 5, 
            'nombremunicipio' => 'Humuya',      
            'departamento' => 3,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 6, 
            'nombremunicipio' => 'La Libertad',      
            'departamento' => 3,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 7, 
            'nombremunicipio' => 'Laman??',      
            'departamento' => 3,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 8, 
            'nombremunicipio' => 'La Trinidad',      
            'departamento' => 3,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 9, 
            'nombremunicipio' => 'Lejaman??',      
            'departamento' => 3,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 10, 
            'nombremunicipio' => 'Me??mbar',      
            'departamento' => 3,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 11, 
            'nombremunicipio' => 'Minas de Oro',      
            'departamento' => 3,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 12, 
            'nombremunicipio' => 'Ojos de Agua',      
            'departamento' => 3,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 13, 
            'nombremunicipio' => 'San Jer??nimo ',      
            'departamento' => 3,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 14, 
            'nombremunicipio' => 'San Jos?? de Comayagua',      
            'departamento' => 3,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 15, 
            'nombremunicipio' => 'San Jos?? del Potrero',      
            'departamento' => 3,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 16, 
            'nombremunicipio' => 'San Luis',      
            'departamento' => 3,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 17, 
            'nombremunicipio' => 'San Sebasti??n',      
            'departamento' => 3,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 18, 
            'nombremunicipio' => 'Siguatepeque',      
            'departamento' => 3,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 19, 
            'nombremunicipio' => 'Villa de San Antonio',      
            'departamento' => 3,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 20, 
            'nombremunicipio' => 'Las Lajas',      
            'departamento' => 3,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 21, 
            'nombremunicipio' => 'Taulab??',      
            'departamento' => 3,  
        ]);

        //copan
        DB::table("municipios")->insert([
            'codigo' => 1, 
            'nombremunicipio' => 'Santa Rosa de Cop??n',      
            'departamento' => 4,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 2, 
            'nombremunicipio' => 'Caba??as',      
            'departamento' => 4,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 3, 
            'nombremunicipio' => 'Concepci??n',      
            'departamento' => 4,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 4, 
            'nombremunicipio' => 'Cop??n Ruinas',      
            'departamento' => 4,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 5, 
            'nombremunicipio' => 'Corqu??n',      
            'departamento' => 4,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 6, 
            'nombremunicipio' => 'Cucuyagua',      
            'departamento' => 4,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 7, 
            'nombremunicipio' => 'Dolores',      
            'departamento' => 4,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 8, 
            'nombremunicipio' => 'Dulce Nombre',      
            'departamento' => 4,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 9, 
            'nombremunicipio' => 'El Para??so',      
            'departamento' => 4,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 10, 
            'nombremunicipio' => 'Florida',      
            'departamento' => 4,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 11, 
            'nombremunicipio' => 'La Jigua',      
            'departamento' => 4,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 12, 
            'nombremunicipio' => 'La Uni??n',      
            'departamento' => 4,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 13, 
            'nombremunicipio' => 'Nueva Arcadia',      
            'departamento' => 4,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 14, 
            'nombremunicipio' => 'San Agust??n',      
            'departamento' => 4,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 15, 
            'nombremunicipio' => 'San Antonio',      
            'departamento' => 4,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 16, 
            'nombremunicipio' => 'San Jer??nimo',      
            'departamento' => 4,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 17, 
            'nombremunicipio' => 'San Jos??',      
            'departamento' => 4,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 18, 
            'nombremunicipio' => 'San Juan de Opoa',      
            'departamento' => 4,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 19, 
            'nombremunicipio' => 'San Nicol??s',      
            'departamento' => 4,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 20, 
            'nombremunicipio' => 'San Pedro',      
            'departamento' => 4,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 21, 
            'nombremunicipio' => 'Santa Rita',      
            'departamento' => 4,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 22, 
            'nombremunicipio' => 'Trinidad de Cop??n',      
            'departamento' => 4,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 23, 
            'nombremunicipio' => 'Veracruz',      
            'departamento' => 4,  
        ]);

        //Cortes
        DB::table("municipios")->insert([
            'codigo' => 1, 
            'nombremunicipio' => 'San Pedro Sula',      
            'departamento' => 5,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 2, 
            'nombremunicipio' => 'Choloma',      
            'departamento' => 5,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 3, 
            'nombremunicipio' => 'Omoa',      
            'departamento' => 5,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 4, 
            'nombremunicipio' => 'Pimienta',      
            'departamento' => 5,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 5, 
            'nombremunicipio' => 'Potrerillos',      
            'departamento' => 5,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 6, 
            'nombremunicipio' => 'Puerto Cort??s',      
            'departamento' => 5,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 7, 
            'nombremunicipio' => 'San Antonio de Cort??s',      
            'departamento' => 5,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 8, 
            'nombremunicipio' => 'San Francisco de Yojoa',      
            'departamento' => 5,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 9, 
            'nombremunicipio' => 'San Manuel',      
            'departamento' => 5,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 10, 
            'nombremunicipio' => 'Santa Cruz de Yojoa',      
            'departamento' => 5,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 11, 
            'nombremunicipio' => 'Villanueva',      
            'departamento' => 5,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 12, 
            'nombremunicipio' => 'La Lima',      
            'departamento' => 5,  
        ]);

        //choluteca
        DB::table("municipios")->insert([
            'codigo' => 1, 
            'nombremunicipio' => 'Choluteca',      
            'departamento' => 6,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 2, 
            'nombremunicipio' => 'Apacilagua',      
            'departamento' => 6,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 3, 
            'nombremunicipio' => 'Concepci??n de Mar??a',      
            'departamento' => 6,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 4, 
            'nombremunicipio' => 'Duyure',      
            'departamento' => 6,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 5, 
            'nombremunicipio' => 'El Corpus',      
            'departamento' => 6,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 6, 
            'nombremunicipio' => 'El Triunfo',      
            'departamento' => 6,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 7, 
            'nombremunicipio' => 'Marcovia',      
            'departamento' => 6,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 8, 
            'nombremunicipio' => 'Morolica',      
            'departamento' => 6,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 9, 
            'nombremunicipio' => 'Namasig??e',      
            'departamento' => 6,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 10, 
            'nombremunicipio' => 'Orocuina',      
            'departamento' => 6,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 11, 
            'nombremunicipio' => 'Pespire',      
            'departamento' => 6,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 12, 
            'nombremunicipio' => 'San Antonio de Flores',      
            'departamento' => 6,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 13, 
            'nombremunicipio' => 'San Isidro',      
            'departamento' => 6,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 14, 
            'nombremunicipio' => 'San Jos??',      
            'departamento' => 6,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 15, 
            'nombremunicipio' => 'San Marcos de Col??n',      
            'departamento' => 6,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 16, 
            'nombremunicipio' => 'Santa Ana de Yusguare',      
            'departamento' => 6,  
        ]);

        //El Paraiso
        DB::table("municipios")->insert([
            'codigo' => 1, 
            'nombremunicipio' => 'Yuscar??n',      
            'departamento' => 7,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 2, 
            'nombremunicipio' => 'Alauca',      
            'departamento' => 7,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 3, 
            'nombremunicipio' => 'Danl??',      
            'departamento' => 7,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 4, 
            'nombremunicipio' => 'El Para??so',      
            'departamento' => 7,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 5, 
            'nombremunicipio' => 'G??inope',      
            'departamento' => 7,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 6, 
            'nombremunicipio' => 'Jacaleapa',      
            'departamento' => 7,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 7, 
            'nombremunicipio' => 'Liure',      
            'departamento' => 7,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 8, 
            'nombremunicipio' => 'Morocel??',      
            'departamento' => 7,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 9, 
            'nombremunicipio' => 'Oropol??',      
            'departamento' => 7,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 10, 
            'nombremunicipio' => 'Potrerillos',      
            'departamento' => 7,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 11, 
            'nombremunicipio' => 'San Antonio de Flores',      
            'departamento' => 7,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 12, 
            'nombremunicipio' => 'San Lucas',      
            'departamento' => 7,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 13, 
            'nombremunicipio' => 'San Mat??as',      
            'departamento' => 7,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 14, 
            'nombremunicipio' => 'Soledad',      
            'departamento' => 7,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 15, 
            'nombremunicipio' => 'Teupasenti',      
            'departamento' => 7,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 16, 
            'nombremunicipio' => 'Texiguat',      
            'departamento' => 7,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 17, 
            'nombremunicipio' => 'Vado Ancho',      
            'departamento' => 7,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 18, 
            'nombremunicipio' => 'Yauyupe',      
            'departamento' => 7,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 19, 
            'nombremunicipio' => 'Trojes',      
            'departamento' => 7,  
        ]);

        //Francisco Morazan 
        DB::table("municipios")->insert([
            'codigo' => 1, 
            'nombremunicipio' => 'Distrito Central',      
            'departamento' => 8,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 2, 
            'nombremunicipio' => 'Alubar??n',      
            'departamento' => 8,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 3, 
            'nombremunicipio' => 'Cedros',      
            'departamento' => 8,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 4, 
            'nombremunicipio' => 'Curar??n',      
            'departamento' => 8,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 5, 
            'nombremunicipio' => 'El Porvenir',      
            'departamento' => 8,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 6, 
            'nombremunicipio' => 'Guaimaca',      
            'departamento' => 8,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 7, 
            'nombremunicipio' => 'La Libertad',      
            'departamento' => 8,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 8, 
            'nombremunicipio' => 'La Venta',      
            'departamento' => 8,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 9, 
            'nombremunicipio' => 'Lepaterique',      
            'departamento' => 8,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 10, 
            'nombremunicipio' => 'Maraita',      
            'departamento' => 8,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 11, 
            'nombremunicipio' => 'Marale',      
            'departamento' => 8,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 12, 
            'nombremunicipio' => 'Nueva Armenia',      
            'departamento' => 8,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 13, 
            'nombremunicipio' => 'Ojojona',      
            'departamento' => 8,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 14, 
            'nombremunicipio' => 'Orica',      
            'departamento' => 8,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 15, 
            'nombremunicipio' => 'Reitoca',      
            'departamento' => 8,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 16, 
            'nombremunicipio' => 'Sabanagrande',      
            'departamento' => 8,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 17, 
            'nombremunicipio' => 'San Antonio de Oriente',      
            'departamento' => 8,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 18, 
            'nombremunicipio' => 'San Buenaventura',      
            'departamento' => 8,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 19, 
            'nombremunicipio' => 'San Ignacio',      
            'departamento' => 8,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 20, 
            'nombremunicipio' => 'Cantarranas',      
            'departamento' => 8,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 21, 
            'nombremunicipio' => 'San Miguelito',      
            'departamento' => 8,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 22, 
            'nombremunicipio' => 'Santa Ana',      
            'departamento' => 8,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 23, 
            'nombremunicipio' => 'Santa Luc??a',      
            'departamento' => 8,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 24, 
            'nombremunicipio' => 'Talanga',      
            'departamento' => 8,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 25, 
            'nombremunicipio' => 'Tatumbla',      
            'departamento' => 8,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 26, 
            'nombremunicipio' => 'Valle de ??ngeles',      
            'departamento' => 8,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 27, 
            'nombremunicipio' => 'Villa de San Francisco',      
            'departamento' => 8,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 28, 
            'nombremunicipio' => 'Vallecillo',      
            'departamento' => 8,  
        ]);

        //Gracias a Dios 
        DB::table("municipios")->insert([
            'codigo' => 1, 
            'nombremunicipio' => 'Puerto Lempira',      
            'departamento' => 9,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 2, 
            'nombremunicipio' => 'Brus Laguna',      
            'departamento' => 9,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 3, 
            'nombremunicipio' => 'Ahuas',      
            'departamento' => 9,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 4, 
            'nombremunicipio' => 'Juan Francisco Bulnes',      
            'departamento' => 9,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 5, 
            'nombremunicipio' => 'Ram??n Villeda Morales',      
            'departamento' => 9,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 6, 
            'nombremunicipio' => 'Wampusirpe',      
            'departamento' => 9,  
        ]);

        //Intibuca
        DB::table("municipios")->insert([
            'codigo' => 1, 
            'nombremunicipio' => 'La Esperanza',      
            'departamento' => 10,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 2, 
            'nombremunicipio' => 'Camasca',      
            'departamento' => 10,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 3, 
            'nombremunicipio' => 'Colomoncagua',      
            'departamento' => 10,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 4, 
            'nombremunicipio' => 'Concepci??n',      
            'departamento' => 10,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 5, 
            'nombremunicipio' => 'Dolores',      
            'departamento' => 10,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 6, 
            'nombremunicipio' => 'Intibuc??',      
            'departamento' => 10,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 7, 
            'nombremunicipio' => 'Jes??s de Otoro',      
            'departamento' => 10,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 8, 
            'nombremunicipio' => 'Magdalena',      
            'departamento' => 10,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 9, 
            'nombremunicipio' => 'Masaguara',      
            'departamento' => 10,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 10, 
            'nombremunicipio' => 'San Antonio',      
            'departamento' => 10,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 11, 
            'nombremunicipio' => 'San Isidro',      
            'departamento' => 10,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 12, 
            'nombremunicipio' => 'San Juan',      
            'departamento' => 10,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 13, 
            'nombremunicipio' => 'San Marcos de la Sierra',      
            'departamento' => 10,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 14, 
            'nombremunicipio' => 'San Miguel Guancapla',      
            'departamento' => 10,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 15, 
            'nombremunicipio' => 'Santa Luc??a',      
            'departamento' => 10,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 16, 
            'nombremunicipio' => 'Yamaranguila',      
            'departamento' => 10,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 17, 
            'nombremunicipio' => 'San Francisco de Opalaca',      
            'departamento' => 10,  
        ]);

        //Isas de la bahia 
        DB::table("municipios")->insert([
            'codigo' => 1, 
            'nombremunicipio' => 'Roat??n',      
            'departamento' => 11,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 2, 
            'nombremunicipio' => 'Guanaja',      
            'departamento' => 11,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 3, 
            'nombremunicipio' => 'Jos?? Santos Guardiola',      
            'departamento' => 11,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 4, 
            'nombremunicipio' => 'Utila',      
            'departamento' => 11,  
        ]);
        

        //a Paz
        DB::table("municipios")->insert([
            'codigo' => 1, 
            'nombremunicipio' => 'La Paz',      
            'departamento' => 12,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 2, 
            'nombremunicipio' => 'Aguanqueterique',      
            'departamento' => 12,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 3, 
            'nombremunicipio' => 'Caba??as',      
            'departamento' => 12,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 4, 
            'nombremunicipio' => 'Cane',      
            'departamento' => 12,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 5, 
            'nombremunicipio' => 'Chinacla',      
            'departamento' => 12,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 6, 
            'nombremunicipio' => 'Guajiquiro',      
            'departamento' => 12,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 7, 
            'nombremunicipio' => 'Lauterique',      
            'departamento' => 12,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 8, 
            'nombremunicipio' => 'Marcala',      
            'departamento' => 12,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 9, 
            'nombremunicipio' => 'Mercedes de Oriente',      
            'departamento' => 12,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 10, 
            'nombremunicipio' => 'Opatoro',      
            'departamento' => 12,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 11, 
            'nombremunicipio' => 'San Antonio del Norte',      
            'departamento' => 12,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 12, 
            'nombremunicipio' => 'San Jos??',      
            'departamento' => 12,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 13, 
            'nombremunicipio' => 'San Juan',      
            'departamento' => 12,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 14, 
            'nombremunicipio' => 'San Pedro de Tutule',      
            'departamento' => 12,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 15, 
            'nombremunicipio' => 'Santa Ana ',      
            'departamento' => 12,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 16, 
            'nombremunicipio' => 'Santa Elena',      
            'departamento' => 12,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 17, 
            'nombremunicipio' => 'Santa Mar??a',      
            'departamento' => 12,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 18, 
            'nombremunicipio' => 'Santiago de Puringla',      
            'departamento' => 12,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 19, 
            'nombremunicipio' => 'Yarula',      
            'departamento' => 12,
        ]);

        //lempira
        DB::table("municipios")->insert([
            'codigo' => 1, 
            'nombremunicipio' => 'Gracias',      
            'departamento' => 13,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 2, 
            'nombremunicipio' => 'Bel??n',      
            'departamento' => 13,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 3, 
            'nombremunicipio' => 'Candelaria',      
            'departamento' => 13,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 4, 
            'nombremunicipio' => 'Cololaca',      
            'departamento' => 13,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 5, 
            'nombremunicipio' => 'Erandique',      
            'departamento' => 13,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 6, 
            'nombremunicipio' => 'Gualcince',      
            'departamento' => 13,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 7, 
            'nombremunicipio' => 'Guarita',      
            'departamento' => 13,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 8, 
            'nombremunicipio' => 'La Campa',      
            'departamento' => 13,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 9, 
            'nombremunicipio' => 'La Iguala',      
            'departamento' => 13,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 10, 
            'nombremunicipio' => 'Las Flores',      
            'departamento' => 13,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 11, 
            'nombremunicipio' => 'La Uni??n',      
            'departamento' => 13,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 12, 
            'nombremunicipio' => 'La Virtud',      
            'departamento' => 13,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 13, 
            'nombremunicipio' => 'Lepaera',      
            'departamento' => 13,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 14, 
            'nombremunicipio' => 'Mapulaca',      
            'departamento' => 13,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 15, 
            'nombremunicipio' => 'Piraera',      
            'departamento' => 13,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 16, 
            'nombremunicipio' => 'San Andr??s',      
            'departamento' => 13,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 17, 
            'nombremunicipio' => 'San Francisco',      
            'departamento' => 13,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 18, 
            'nombremunicipio' => 'San Juan Guarita',      
            'departamento' => 13,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 19, 
            'nombremunicipio' => 'San Manuel Colohete',      
            'departamento' => 13,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 20, 
            'nombremunicipio' => 'San Rafael',      
            'departamento' => 13,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 21, 
            'nombremunicipio' => 'San Sebasti??n',      
            'departamento' => 13,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 22, 
            'nombremunicipio' => 'Santa Cruz',      
            'departamento' => 13,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 23, 
            'nombremunicipio' => 'Talgua',      
            'departamento' => 13,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 24, 
            'nombremunicipio' => 'Tambla',      
            'departamento' => 13,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 25, 
            'nombremunicipio' => 'Tomal??',      
            'departamento' => 13,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 26, 
            'nombremunicipio' => 'Valladolid',      
            'departamento' => 13,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 27, 
            'nombremunicipio' => 'Virginia',      
            'departamento' => 13,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 28, 
            'nombremunicipio' => 'San Marcos de Caiqu??n',      
            'departamento' => 13,  
        ]);

        //ocotepeque

                DB::table("municipios")->insert([
            'codigo' => 1, 
            'nombremunicipio' => 'Nueva Ocotepeque',      
            'departamento' => 14,  
        ]);
                DB::table("municipios")->insert([
            'codigo' => 2, 
            'nombremunicipio' => 'Bel??n Gualcho',      
            'departamento' => 14,  
        ]);
                DB::table("municipios")->insert([
            'codigo' => 3, 
            'nombremunicipio' => 'Concepci??n',      
            'departamento' => 14,  
        ]);
                DB::table("municipios")->insert([
            'codigo' => 4, 
            'nombremunicipio' => 'Dolores Merend??n',      
            'departamento' => 14,  
        ]);
                DB::table("municipios")->insert([
            'codigo' => 5, 
            'nombremunicipio' => 'Fraternidad',      
            'departamento' => 14,  
        ]);
                DB::table("municipios")->insert([
            'codigo' => 6, 
            'nombremunicipio' => 'La Encarnaci??n',      
            'departamento' => 14,  
        ]);
                DB::table("municipios")->insert([
            'codigo' => 7, 
            'nombremunicipio' => 'La Labor',      
            'departamento' => 14,  
        ]);
                DB::table("municipios")->insert([
            'codigo' => 8, 
            'nombremunicipio' => 'Lucerna',      
            'departamento' => 14,  
        ]);
                DB::table("municipios")->insert([
            'codigo' => 9, 
            'nombremunicipio' => 'Mercedes',      
            'departamento' => 14,  
        ]);
                DB::table("municipios")->insert([
            'codigo' => 10, 
            'nombremunicipio' => 'San Fernando',      
            'departamento' => 14,  
        ]);
                DB::table("municipios")->insert([
            'codigo' => 11, 
            'nombremunicipio' => 'San Francisco del Valle',      
            'departamento' => 14,  
        ]);
                DB::table("municipios")->insert([
            'codigo' => 12, 
            'nombremunicipio' => 'San Jorge',      
            'departamento' => 14,  
        ]);
                DB::table("municipios")->insert([
            'codigo' => 13, 
            'nombremunicipio' => 'San Marcos',      
            'departamento' => 14,  
        ]);
                DB::table("municipios")->insert([
            'codigo' => 14, 
            'nombremunicipio' => 'Santa Fe',      
            'departamento' => 14,  
        ]);
                DB::table("municipios")->insert([
            'codigo' => 15, 
            'nombremunicipio' => 'Sensenti',      
            'departamento' => 14,  
        ]);
                DB::table("municipios")->insert([
            'codigo' => 16, 
            'nombremunicipio' => 'Sinuapa',      
            'departamento' => 14,  
        ]);


        //olancho

        DB::table("municipios")->insert([
            'codigo' => 1, 
            'nombremunicipio' => 'Juticalpa',      
            'departamento' => 15,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 2, 
            'nombremunicipio' => 'Campamento',      
            'departamento' => 15,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 3, 
            'nombremunicipio' => 'Catacamas',      
            'departamento' => 15,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 4, 
            'nombremunicipio' => 'Concordia',      
            'departamento' => 15,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 5, 
            'nombremunicipio' => 'Dulce Nombre de Culm??',      
            'departamento' => 15,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 6, 
            'nombremunicipio' => 'El Rosario',      
            'departamento' => 15,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 7, 
            'nombremunicipio' => 'Esquipulas del Norte',      
            'departamento' => 15,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 8, 
            'nombremunicipio' => 'Gualaco',      
            'departamento' => 15,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 9, 
            'nombremunicipio' => 'Guarizama',      
            'departamento' => 15,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 10, 
            'nombremunicipio' => 'Guata',      
            'departamento' => 15,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 11, 
            'nombremunicipio' => 'Guayape',      
            'departamento' => 15,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 12, 
            'nombremunicipio' => 'Jano',      
            'departamento' => 15,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 13, 
            'nombremunicipio' => 'La Uni??n',      
            'departamento' => 15,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 14, 
            'nombremunicipio' => 'Mangulile',      
            'departamento' => 15,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 15, 
            'nombremunicipio' => 'Manto',      
            'departamento' => 15,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 16, 
            'nombremunicipio' => 'Salam??',      
            'departamento' => 15,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 17, 
            'nombremunicipio' => 'San Esteban',      
            'departamento' => 15,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 18, 
            'nombremunicipio' => 'San Francisco de Becerra',      
            'departamento' => 15,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 19, 
            'nombremunicipio' => 'San Francisco de la Paz',      
            'departamento' => 15,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 20, 
            'nombremunicipio' => 'Santa Mar??a del Real',      
            'departamento' => 15,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 21, 
            'nombremunicipio' => 'Silca',      
            'departamento' => 15,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 22, 
            'nombremunicipio' => 'Yoc??n',      
            'departamento' => 15,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 23, 
            'nombremunicipio' => 'Patuca',      
            'departamento' => 15,  
        ]);

        //santa barbara
        DB::table("municipios")->insert([
            'codigo' => 1, 
            'nombremunicipio' => 'Santa B??rbara',      
            'departamento' => 16,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 2, 
            'nombremunicipio' => 'Arada',      
            'departamento' => 16,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 3, 
            'nombremunicipio' => 'Atima',      
            'departamento' => 16,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 4, 
            'nombremunicipio' => 'Azacualpa',      
            'departamento' => 16,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 5, 
            'nombremunicipio' => 'Ceguaca',      
            'departamento' => 16,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 6, 
            'nombremunicipio' => 'San Jos?? de las Colinas',      
            'departamento' => 16,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 7, 
            'nombremunicipio' => 'Concepci??n del Norte',      
            'departamento' => 16,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 8, 
            'nombremunicipio' => 'Concepci??n del Sur',      
            'departamento' => 16,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 9, 
            'nombremunicipio' => 'Chinda',      
            'departamento' => 16,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 10, 
            'nombremunicipio' => 'El N??spero',      
            'departamento' => 16,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 11, 
            'nombremunicipio' => 'Gualala',      
            'departamento' => 16,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 12, 
            'nombremunicipio' => 'Ilama',      
            'departamento' => 16,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 13, 
            'nombremunicipio' => 'Macuelizo',      
            'departamento' => 16,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 14, 
            'nombremunicipio' => 'Naranjito',      
            'departamento' => 16,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 15, 
            'nombremunicipio' => 'Nuevo Celilac',      
            'departamento' => 16,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 16, 
            'nombremunicipio' => 'Petoa',      
            'departamento' => 16,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 17, 
            'nombremunicipio' => 'Protecci??n',      
            'departamento' => 16,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 18, 
            'nombremunicipio' => 'Quimist??n',      
            'departamento' => 16,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 19, 
            'nombremunicipio' => 'San Francisco de Ojuera',      
            'departamento' => 16,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 20, 
            'nombremunicipio' => 'San Luis',      
            'departamento' => 16,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 21, 
            'nombremunicipio' => 'San Marcos',      
            'departamento' => 16,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 22, 
            'nombremunicipio' => 'San Nicol??s',      
            'departamento' => 16,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 23, 
            'nombremunicipio' => 'San Pedro Zacapa',      
            'departamento' => 16,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 24, 
            'nombremunicipio' => 'Santa Rita',      
            'departamento' => 16,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 25, 
            'nombremunicipio' => 'San Vicente Centenario',      
            'departamento' => 16,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 26, 
            'nombremunicipio' => 'Trinidad',      
            'departamento' => 16,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 27, 
            'nombremunicipio' => 'Las Vegas',      
            'departamento' => 16,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 28, 
            'nombremunicipio' => 'Nueva Frontera',      
            'departamento' => 16,  
        ]);

        //valle
        DB::table("municipios")->insert([
            'codigo' => 1, 
            'nombremunicipio' => 'Nacaome',      
            'departamento' => 17,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 2, 
            'nombremunicipio' => 'Alianza',      
            'departamento' => 17,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 3, 
            'nombremunicipio' => 'Amapala',      
            'departamento' => 17,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 4, 
            'nombremunicipio' => 'Aramecina',      
            'departamento' => 17,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 5, 
            'nombremunicipio' => 'Caridad',      
            'departamento' => 17,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 6, 
            'nombremunicipio' => 'Goascor??n',      
            'departamento' => 17,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 7, 
            'nombremunicipio' => 'Langue',      
            'departamento' => 17,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 8, 
            'nombremunicipio' => 'San Francisco de Coray',      
            'departamento' => 17,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 9, 
            'nombremunicipio' => 'San Lorenzo',      
            'departamento' => 17,  
        ]);

        //yoro
        DB::table("municipios")->insert([
            'codigo' => 1, 
            'nombremunicipio' => 'Yoro',      
            'departamento' => 18,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 2, 
            'nombremunicipio' => 'Arenal',      
            'departamento' => 18,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 3, 
            'nombremunicipio' => 'El Negrito',      
            'departamento' => 18,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 4, 
            'nombremunicipio' => 'El Progreso',      
            'departamento' => 18,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 5, 
            'nombremunicipio' => 'Joc??n',      
            'departamento' => 18,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 6, 
            'nombremunicipio' => 'Moraz??n',      
            'departamento' => 18,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 7, 
            'nombremunicipio' => 'Olanchito',      
            'departamento' => 18,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 8, 
            'nombremunicipio' => 'Santa Rita',      
            'departamento' => 18,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 9, 
            'nombremunicipio' => 'Sulaco',      
            'departamento' => 18,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 10, 
            'nombremunicipio' => 'Victoria',      
            'departamento' => 18,  
        ]);
        DB::table("municipios")->insert([
            'codigo' => 11, 
            'nombremunicipio' => 'Yorito',      
            'departamento' => 18,  
        ]);

        
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('municipios');
    }
}
