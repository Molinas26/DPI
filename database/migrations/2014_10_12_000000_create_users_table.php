<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('placa')->unique();
            $table->string('telefono')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table("users")
        ->insert([
            'name' => 'Soporte Tecnico',
            'email' => 'dpisoport@gmail.com',
            'placa' => '00000',
            'telefono' => '00000000',
            'password' => '$2y$10$AluNc8YndjBpdof62Q4wAesLlvzCLwgkUh.QzutYZjfi8Y8YZN4KC',
            
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
