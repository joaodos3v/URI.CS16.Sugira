<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerfilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
        * FALTA EU CRIAR AS COLUNAS DE PERMISSÕES AQUI!!!!!
        */
        Schema::create('perfils', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descricao', 50);
            $table->boolean('menu_dashboard');
            $table->boolean('menu_usuarios');
            $table->boolean('menu_perfis');
            $table->boolean('menu_prefeituras');
            $table->boolean('menu_generos');
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
        Schema::dropIfExists('perfils');
    }
}
