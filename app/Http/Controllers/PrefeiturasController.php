<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrefeiturasController extends Controller {
    
	public function index() {
		return view('prefeituras.index');
	}

}
