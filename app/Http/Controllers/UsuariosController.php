<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;

class UsuariosController extends Controller {
    
	public function edit() {
		return view('usuarios.edit');
	}

	public function update(Request $request) {
		$status              = "";
        $senha_atual         = $request->senha_atual;
        $novaSenha           = $request->nova_senha;
        $novaSenha_confirm   = $request->novaSenha_confirm;
        $nome 				 = $request->name;
        $idUser              = Auth::user()->id;

        $user = User::find($idUser);
        if($nome != $user->name) {
        	$user->name = $nome;
        	$user->save();
        }

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

}
