<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users_App extends Model {
    
	protected $fillable = ['id', 'email', 'senha', 'cidade_id'];

}
