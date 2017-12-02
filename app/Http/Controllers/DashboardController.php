<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Sugestao;
use App\Prefeituras;
use App\Cidades;
use App\Classificacao;
use App\Generos;

class DashboardController extends Controller {
    
	public function index() {
		$user 		= Auth::user();
		$prefeitura = Prefeituras::find($user->prefeitura_id);
		$cidade 	= Cidades::find($prefeitura->cidade_id);
		
		
		$sugestoes 		= DB::table('sugestaos')->where('cidade_id', '=', $cidade->id)->get();
		foreach ($sugestoes as $key => $value) {
			$classificacao 					= Classificacao::find($value->classificacao_id);
			$genero 						= Generos::find($value->genero_id);
			$sugestoes[$key]->classificacao = $classificacao->descricao;
			$sugestoes[$key]->genero 		= $genero->descricao;
		}

		$abertas 		= DB::table('sugestaos')->where('cidade_id', '=', $cidade->id)->where('status', '=', 'Aberta')->get();
		$em_andamento 	= DB::table('sugestaos')->where('cidade_id', '=', $cidade->id)->where('status', '=', 'Em Andamento')->get();
		$concluidas 	= DB::table('sugestaos')->where('cidade_id', '=', $cidade->id)->where('status', '=', 'Concluida')->get();
		return view('dashboard', compact('sugestoes', 'cidade', 'abertas', 'em_andamento', 'concluidas'));
	}

	public function edit(Request $request) {
		$sugestao 						= Sugestao::find($request->id);
		$classificacao 					= Classificacao::find($sugestao->classificacao_id);
		$sugestao->classificacao 		= $classificacao->descricao;

		$status	  = array('Aberta' => 'Aberta', 'Em Andamento' => 'Em Andamento', 'Concluida' => 'Concluida');
		return view('edit', compact('sugestao', 'status'));
	}

	public function update(Request $request, $id) {
		$sugestao = Sugestao::find($request->id);
		$sugestao->status = $request->status;
		$sugestao->save();

		return redirect()->route('dashboard')->with('sucesso', 'mensagem');
	}


}
