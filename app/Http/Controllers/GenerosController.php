<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Generos;

class GenerosController extends Controller {
    
	public function index() {
		$generos = DB::table('generos')->orderBy('id', 'asc')->get();
		return view('generos.index', compact('generos'));
	}

	public function store(Request $request) {
		$novoGenero = $request->all();
		Generos::create($novoGenero);

		return redirect()->route('generos')->with('sucesso_inserir', 'Gênero inserido com sucesso!');
	}

	public function exclude(Request $request) {
		try {
            Generos::find($request->id)->delete();
			return response()->json(['response' => 'Sucesso_Excluir']);
        } catch(QueryException $e) {
			return response()->json(['response' => 'Erro_Excluir']);
        }
	}

}
