<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSugestoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sugestoes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descricao', 100);
            $table->string('status', 100);
            $table->string('endereco', 100);
            $table->integer('numero');
            $table->binary('base64'); // Não foi mudado o nome da coluna porque já existem vinculações demais ao nome
            $table->integer('genero_id')->unsigned();
            $table->foreign('genero_id')->references('id')->on('generos');
            $table->integer('classificacao_id')->unsigned();
            $table->foreign('classificacao_id')->references('id')->on('classificacaos');
            $table->integer('cidade_id')->unsigned();
            $table->foreign('cidade_id')->references('id')->on('cidades');
            $table->integer('user_criador_id')->unsigned();
            $table->foreign('user_criador_id')->references('id')->on('users__apps');
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
        Schema::dropIfExists('sugestoes');
    }
}
