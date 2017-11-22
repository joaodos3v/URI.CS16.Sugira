<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Generos;
use App\Cidades;
use App\Users_App;
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
		
		return response()->json( ['logado' => $logado] );
	}


}
