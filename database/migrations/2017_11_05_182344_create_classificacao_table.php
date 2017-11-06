<?php
// PS: Com o nome correto não estava funcionando, por isso ficou 'classificacaos'

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassificacaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classificacaos', function(Blueprint $table) {
            $table->increments('id');
            $table->string('descricao', 15);
            $table->integer('prioridade');
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
        Schema::dropIfExists('classificacaos');
    }
}
