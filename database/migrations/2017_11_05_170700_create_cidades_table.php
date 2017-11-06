<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cidades', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('estado_id')->unsigned();
            $table->foreign('estado_id')->references('id')->on('estados');
            $table->string('cod_ibge', 10);
            $table->string('nome', 60);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cidades');
    }
}
