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
		$data = $request->all(); //read json in request
		return response()->json(['teste' => $data]); //send json respond


		
	}


}
