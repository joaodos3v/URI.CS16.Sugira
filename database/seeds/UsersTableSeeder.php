<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Perfil;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
    	$perfil = Perfil::find(1);

        $admin = new User();
        $admin->name 		= 'Sugira Admin';
        $admin->email 		= 'joaovitorvv@gmail.com';
        $admin->perfil 		= $perfil->descricao;
        $admin->perfil_id 	= $perfil->id;
        $admin->password 	= bcrypt('123456');
        $admin->save();
    }
}
