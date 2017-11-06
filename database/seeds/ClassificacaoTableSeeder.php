<?php

use Illuminate\Database\Seeder;
use App\Classificacao;

class ClassificacaoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $c_muitoUrgente = new Classificacao();
        $c_muitoUrgente->descricao	= 'Muito Urgente';
        $c_muitoUrgente->prioridade	= 1;
        $c_muitoUrgente->save();

        $c_urgente = new Classificacao();
        $c_urgente->descricao	= 'Urgente';
        $c_urgente->prioridade	= 2;
        $c_urgente->save();

        $c_media = new Classificacao();
        $c_media->descricao		= 'Média';
        $c_media->prioridade	= 3;
        $c_media->save();

        $c_leve = new Classificacao();
        $c_leve->descricao		= 'Leve';
        $c_leve->prioridade		= 4;
        $c_leve->save();
    }
}
