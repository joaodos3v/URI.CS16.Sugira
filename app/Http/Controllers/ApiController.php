<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Generos;
use Illuminate\Support\Facades\Input;

class ApiController extends Controller {
    
	public function getGeneros() {
		$g = Generos::all();
		return response()->json( $g );
	}

	public function postLogin() {
		// $data = $request->json()->all(); //read json in request
		// return response()->json($data); //send json respond
		$data = Input::all(); //read json in request
		return response()->json($data); //send json respond
	}

}
