@extends('main');
@section('title_page', "Usuários");

@section('content')
	<div class="container">
		<div class="row">
	        <div class="col-md-8 col-md-offset-1">
	            <div class="card">
	            	 <div class="card-header" data-background-color="green">
	                    <h4 class="title">Usuários</h4>
	                    <p class="category">Estes são os usuários do sistema</p>
	                </div>
	                <div class="card-content table-responsive">
	                	<table class="table table-hover">
	                		<thead>
	                			<th>#</th>
	                			<th>Nome</th>
	                			<th>Perfil</th>
	                			<th>Ações</th>
	                		</thead>
	                		<tbody>
	                			@foreach($usuarios as $user)
			                        <tr>
			                            <td> {{ $user->id }} </td>
			                            <td> {{ $user->name }} </td>
			                            <td> --- </td>
			                            <td>
			                                {{-- <a href="{{ route('perfis.permissions', ['id' => $p->id]) }}" class="btn btn-sm btn-warning btn-round">Permissões</a>
			                                <a class="btn btn-sm btn-info btn-round" onClick="editaPerfil('{{ $p->id }}', '{{ $p->descricao }}')">Editar</a>
			                                <a class="btn btn-sm btn-danger btn-round" onClick="confirmDelete('{{ $p->id }}', '{{ $p->descricao }}')">Deletar</a> --}}
			                            </td>
			                        </tr>
			                    @endforeach
	                		</tbody>
	                	</table>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
@endsection