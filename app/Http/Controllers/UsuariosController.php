<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\User;

class UsuariosController extends Controller {
    
    public function index() {
        $usuarios = DB::table('users')->orderBy('id', 'asc')->get();
        return view('usuarios.index', compact('usuarios'));
    }

	public function edit() {
		return view('usuarios.edit');
	}

	public function update(Request $request) {
		$status              = "";
        $senha_atual         = $request->senha_atual;
        $novaSenha           = $request->nova_senha;
        $novaSenha_confirm   = $request->novaSenha_confirm;
        $idUser              = Auth::user()->id;
        $user                = User::find($idUser);


        if(Hash::check($senha_atual, $user->password)) {
            if(strlen($novaSenha) >= 6) {
                if($novaSenha == $novaSenha_confirm) {
                    $user->password = bcrypt($novaSenha);
                    $user->save();
                    $status = "sucesso";
                } else {
                    $status = "confirmacao_senha_invalida";
                }
            } else {
                $status = "tamanho_minimo";
            }
        } else {
            $status = "senha_atual_invalida";
        }

        return redirect()->route('usuarios.edit')->with($status, 'status');
	}

    public function editPrivate(Request $request) {
        $user = User::find($request->id);
        return view('usuarios.edit_private', compact('user'));   
    }

    public function exclude(Request $request) {
        User::find($request->id)->delete();
        return response()->json(['response' => 'Sucesso_Excluir']);
    }

}
