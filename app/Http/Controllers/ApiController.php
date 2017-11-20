<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Generos;

class ApiController extends Controller {
    
	public function getGeneros() {
		$g = Generos::all();
		return response()->json( $g );
	}

	public function postLogin(Request $request) {
		return response()->json(  $request->json()->all() );	
	}

}
