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
		$logado = false;
		$user_app = DB::table('users__apps')->where('email', '=', $request->email)
											->where('senha', '=', $request->senha)
											->get();

		if(count($user_app) > 0) {
			$logado = true;
		}
		
		return response()->json( ['logado' => $logado, 'id' => $user_app[0]->id ] );
	}


	public function postUser(Request $request) {
		$newUser = new Users_App();
		$newUser->nome		= $request->nome;
		$newUser->email		= $request->email;
		$newUser->senha		= $request->senha;
		$newUser->cidade_id	= $request->cidade_id;
		$newUser->save();
	}


	public function postSugestoesUser(Request $request) {
		$sugestoes = DB::table('sugestoes')->where('cidade_id', '=', $request->id_cidade)->get();
		return response()->json( ['qtd' => count($sugestoes), 'result' => $sugestoes ] );
	}


	public function postNovaSugestao(Request $request) {
		$novaSugestao = new Sugestoes();
		$novaSugestao->descricao 	= $request->descricao; 
		// $novaSugestao->status 		= $sugestao->status;
		// $novaSugestao->endereco		= $sugestao->endereco;
		// $novaSugestao->numero		= $sugestao->numero;
		// $novaSugestao->save();
		



		// Sugestoes::create($sugestao);
		return response()->json( ['result' => $request->all()] );
	}


	public function testeGenero(Request $request) {
		$novoGenero = $request->all();
		Generos::create($novoGenero);
	}


}
