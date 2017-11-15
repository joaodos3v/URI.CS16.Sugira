<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cidades extends Model {
    
	protected $fillable = ['id', 'estado_id', 'cod_ibge', 'nome'];

}
