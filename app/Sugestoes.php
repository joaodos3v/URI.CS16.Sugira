<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sugestoes extends Model {
    
	protected $fillable = ['id', 'descricao', 'status', 'endereco', 'numero', 'base64', 'genero_id', 'classificacao_id', 'cidade_id', 'user_criador_id'];

}
