@extends('main');
@section('title_page', "Permissões do Perfil: $perfil->descricao");

@section('content')
<div class="container">
	{{-- Estilo Específico dos toggles - Usado aqui para sobrescrever os originais --}}
	<style>
	  .toggle.ios, .toggle-on.ios, .toggle-off.ios { border-radius: 20px; }
	  .toggle.ios .toggle-handle { border-radius: 20px; }
	</style>

    <div class="row">
        <div class="col-md-8 col-md-offset-1">
            <div class="card">
            	 <div class="card-header" data-background-color="green">
                    <h4 class="title">Alterar Permissões do Perfil - <b>{{ $perfil->descricao }}</b></h4>
                    <p class="category">Ative o que este perfil terá acesso</p>
                </div>
                <div class="card-content">
                	<div class="col-md-10 col-md-offset-1">
                		<h4>Menus</h4>
					    {!! Form::open(['route' => ['perfis.store.permissions', $perfil->id], 'method' => 'put']) !!}
	                	
		                	<!-- List group -->
						    <ul class="list-group">
						        <li class="list-group-item">
						            <div class="row">
							            <div class="col-md-6 ">
							            	Dashboard - Lista de Sugestões
							            </div>
							            <div class="col-md-2 col-md-offset-2">
							            	<input type="checkbox" name="toggle_dashboard" id="toggle_dashboard" data-toggle="toggle" data-onstyle="success" data-style="ios" data-on="Ativo" data-off="Inativo">
							            </div>
						            </div>
						        </li>
						        <li class="list-group-item">
						            <div class="row">
							            <div class="col-md-6 ">
							            	Perfis de Usuários
							            </div>
							            <div class="col-md-2 col-md-offset-2">
							            	<input type="checkbox" name="toggle_perfis" id="toggle_perfis" data-toggle="toggle" data-onstyle="success" data-style="ios" data-on="Ativo" data-off="Inativo">
							            </div>
						            </div>
						        </li>
						        <li class="list-group-item">
						            <div class="row">
							            <div class="col-md-6 ">
							            	Prefeituras
							            </div>
							            <div class="col-md-2 col-md-offset-2">
							            	<input type="checkbox" name="toggle_prefeituras" id="toggle_prefeituras" data-toggle="toggle" data-onstyle="success" data-style="ios" data-on="Ativo" data-off="Inativo">
							            </div>
						            </div>
						        </li>
						         <li class="list-group-item">
						            <div class="row">
							            <div class="col-md-6 ">
							            	Gêneros
							            </div>
							            <div class="col-md-2 col-md-offset-2">
							            	<input type="checkbox" name="toggle_generos" id="toggle_generos" data-toggle="toggle" data-onstyle="success" data-style="ios" data-on="Ativo" data-off="Inativo">
							            </div>
						            </div>
						        </li>
						    </ul>
	                		
	                		<div class=" pull-right">
	                			<a href="{{ route('perfis') }}" class="btn btn-default">Voltar</a>
	                			<button type="submit" class="btn btn-success">Salvar</button>
	                		</div>
						
						{!! Form::close() !!}
                	</div>

                	<div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection