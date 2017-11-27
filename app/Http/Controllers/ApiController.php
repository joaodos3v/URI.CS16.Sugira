<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Generos;
use App\Cidades;
use App\Users_App;
use App\Sugestoes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class ApiController extends Controller {
    
    /*
    ------------------------
    * GET's
    ------------------------
    */
	public function getGeneros() {
		$g = Generos::all();
		return response()->json( $g );
	}


	public function getCidades() {
		$cidades = DB::table('cidades')->where('id', '>=', 1)
									   ->where('id', '<=', 15)
									   ->orderBy('nome', 'asc')
									   ->get()
									   ->pluck('nome', 'id');
		return response()->json( $cidades );
	}



	/* 
	------------------------
    * POST's
    ------------------------
    */
	public function postLogin(Request $request) {
		$logado 	= false;
		$id 		= 0;
		$idCidade 	= 0;
		$user_app = DB::table('users__apps')->where('email', '=', $request->email)
											->where('senha', '=', $request->senha)
											->get();

		if(count($user_app) > 0) {
			$logado 	= true;
			$id 		= $user_app[0]->id;
			$idCidade 	= $user_app[0]->cidade_id;
		}
		
		return response()->json( ['logado' => $logado, 'id' => $id, 'cidade_id' => $idCidade ] );
	}


	public function postUser(Request $request) {
		$newUser = new Users_App();
		$newUser->nome		= $request->nome;
		$newUser->email		= $request->email;
		$newUser->senha		= $request->senha;
		$newUser->cidade_id	= $request->cidade_id;
		$newUser->save();
		return response()->json( ['result' => 'sucesso'] );
	}


	public function postSugestoesUser(Request $request) {
		// $sugestoes = DB::table('sugestoes')->where('cidade_id', '=', $request->id_cidade)->get();
		$g = Generos::all();
		return response()->json( $g );
		
		$sugestoes = Sugestoes::all();
		if($sugestoes != null) {
			return response()->json( ['teste' => $sugestoes ] );
		} else {
			return response()->json( ['qtd' => count($sugestoes), 'result' => 'lelele' ] );
		}


		foreach ($sugestoes as $key => $value) {
			$classificacao 					= Classificacao::find($value->classificacao_id);
			$genero 						= Generos::find($value->genero_id);
			$sugestoes[$key]->classificacao = $classificacao->descricao;
			$sugestoes[$key]->genero 		= $genero->descricao;
		}

		return response()->json( ['qtd' => count($sugestoes), 'result' => $sugestoes ] );
	}


	public function postNovaSugestao(Request $request) {
		$novaSugestao = new Sugestoes();
		$novaSugestao->descricao 		= $request->descricao; 
		$novaSugestao->status 			= $request->status;
		$novaSugestao->endereco			= $request->endereco;
		$novaSugestao->numero			= $request->numero;
		$novaSugestao->base64			= $request->base64;
		$novaSugestao->genero_id		= $request->genero_id;
		$novaSugestao->classificacao_id	= $request->classificacao_id;
		$novaSugestao->cidade_id		= $request->cidade_id;
		$novaSugestao->user_criador_id	= $request->user_criador_id;
		$novaSugestao->save();
		return response()->json( ['result' => 'sucesso'] );
	}


	public function editaSugestao(Request $request) {
		$sugestao = Sugestoes::find($request->id_sugestao);
		$sugestao->status = $request->novo_status;
		$sugestao->save();

		return response()->json(['result' => 'sucesso']);
	}


	public function testeGenero(Request $request) {
		$novoGenero = $request->all();
		Generos::create($novoGenero);
	}


}
