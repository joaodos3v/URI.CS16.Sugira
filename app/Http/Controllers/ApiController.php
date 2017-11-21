<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Generos;
use App\Cidades;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class ApiController extends Controller {
    
	public function getGeneros() {
		$g = Generos::all();
		return response()->json( $g );
	}

	public function postLogin(Request $request) {
		$novoGenero = $request->all();
		Generos::create($novoGenero);

		// $data = $request->all(); //read json in request
		// return response()->json($data); //send json respond
	}

	public function postUser() {

	}

	public function getCidades() {
		$cidades = DB::table('cidades')->where('id', '>=', 1)
									   ->where('id', '<=', 15)
									   ->orderBy('nome', 'asc')
									   ->get()
									   ->pluck('nome', 'id');
		return response()->json( $cidades );
	}


}
