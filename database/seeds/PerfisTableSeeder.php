<?php

use Illuminate\Database\Seeder;
use App\Perfil;

class PerfisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()  {
        
    	$admin = new Perfil();
        $admin->descricao 			= 'Administrador';
        $admin->menu_dashboard 		= false;
        $admin->menu_usuarios 		= true;
        $admin->menu_perfis 		= true;
        $admin->menu_prefeituras 	= true;
        $admin->menu_generos 		= true;
        $admin->save();

    }
}
