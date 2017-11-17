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
		$novoPerfil = new Perfil();
		$novoPerfil->descricao 			= $request->descricao;
		$novoPerfil->menu_dashboard		= false; 			
		$novoPerfil->menu_usuarios		= false; 			
		$novoPerfil->menu_perfis		= false; 			
		$novoPerfil->menu_prefeituras	= false; 			
		$novoPerfil->menu_generos		= false; 			
		$novoPerfil->save();

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

	public function storePermissions(Request $request, $id) {
		$menu_dashboard 	= (array_key_exists('toggle_dashboard', $request->all())) ? true : false;
		$menu_usuarios 		= (array_key_exists('toggle_usuarios', $request->all())) ? true : false;
		$menu_perfis 		= (array_key_exists('toggle_perfis', $request->all())) ? true : false;
		$menu_prefeituras 	= (array_key_exists('toggle_prefeituras', $request->all())) ? true : false;
		$menu_generos 		= (array_key_exists('toggle_generos', $request->all())) ? true : false;

		$perfil = Perfil::find($id);
		$perfil->menu_dashboard		= $menu_dashboard;
		$perfil->menu_usuarios		= $menu_usuarios;
		$perfil->menu_perfis		= $menu_perfis;
		$perfil->menu_prefeituras	= $menu_prefeituras;
		$perfil->menu_generos		= $menu_generos;
		$perfil->save();

		return redirect()->route('perfis')->with('sucesso_permissoes', 'Permissões atualizadas com sucesso!');
	}

}
