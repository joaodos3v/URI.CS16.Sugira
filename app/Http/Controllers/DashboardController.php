<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Sugestoes;
use App\Prefeituras;
use App\Cidades;
use App\Classificacao;

class DashboardController extends Controller {
    
	public function index() {
		$user 		= Auth::user();
		$prefeitura = Prefeituras::find($user->prefeitura_id);
		$cidade 	= Cidades::find($prefeitura->id);
		
		$sugestoes 		= DB::table('sugestoes')->where('cidade_id', '=', $cidade->id)->get();
		foreach ($sugestoes as $key => $value) {
			$classificacao 					= Classificacao::find($value->classificacao_id);
			$sugestoes[$key]->classificacao = $classificacao->descricao;
		}

		$abertas 		= DB::table('sugestoes')->where('cidade_id', '=', $cidade->id)->where('status', '=', 'Aberta')->get();
		$em_andamento 	= DB::table('sugestoes')->where('cidade_id', '=', $cidade->id)->where('status', '=', 'Em Andamento')->get();
		$concluidas 	= DB::table('sugestoes')->where('cidade_id', '=', $cidade->id)->where('status', '=', 'Concluida')->get();
		return view('dashboard', compact('sugestoes', 'cidade', 'abertas', 'em_andamento', 'concluidas'));
	}

	public function edit(Request $request) {
		$sugestao 						= Sugestoes::find($request->id);
		$classificacao 					= Classificacao::find($sugestao->classificacao_id);
		$sugestao->classificacao 		= $classificacao->descricao;

		$status	  = array('Aberta' => 'Aberta', 'Em Andamento' => 'Em Andamento', 'Concluida' => 'Concluida');
		return view('edit', compact('sugestao', 'status'));
	}

	public function update(Request $request, $id) {
		$sugestao = Sugestoes::find($request->id);
		$sugestao->status = $request->status;
		$sugestao->save();

		return redirect()->route('dashboard')->with('sucesso', 'mensagem');
	}


}
