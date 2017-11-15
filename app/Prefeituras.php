<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prefeituras extends Model {
    
	protected $fillable = ['id', 'cnpj', 'cidade', 'endereco', 'numero', 'cidade_id'];

}
