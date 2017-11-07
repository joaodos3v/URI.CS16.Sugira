<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Perfil;

class PerfilController extends Controller {
    
	public function index() {
		$perfis = DB::table('perfils')->orderBy('id', 'asc')->get();
		return view('perfis.index', compact('perfis'));
	}

	public function store(Request $request) {
		$novoPerfil = $request->all();
		Perfil::create($novoPerfil);

		return redirect()->route('perfis')->with('sucesso_inserir', 'Perfil inserido com sucesso!');
	}

	public function exclude(Request $request) {
		try {
            Perfil::find($request->id)->delete();
			return response()->json(['response' => 'Sucesso_Excluir']);
        } catch(QueryException $e) {
			return response()->json(['response' => 'Erro_Excluir']);
        }
	}

	public function update(Request $request) {
		$perfil = Perfil::find($request->id_perfil);
		$perfil->descricao = $request->descricao;
		$perfil->save();
		
		return redirect()->route('perfis')->with('sucesso_editar', 'Perfil editado com sucesso!');
	}

	public function permissions($id) {
		$perfil = Perfil::find($id);
		return view('perfis.permissions', compact('perfil'));
	}

}
