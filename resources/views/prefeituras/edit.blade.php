@extends('main');
@section('title_page', 'Editando Prefeitura - '.$prefeitura->cidade)

@section('content')
	<div class="row">		
		<div class="col-md-8 col-md-offset-1">
            <div class="card">
                <div class="card-header" data-background-color="green">
                    <h4 class="title">Editando Prefeitura - {{ $prefeitura->cidade }}</h4>
                    <p class="category">Preencha todos os campos</p>
                </div>
                <div class="card-content">
                	@if($errors->any())
						<ul class="alert alert-danger">
							@foreach($errors->all() as $error)
								<li> {{ $error }} </li>
							@endforeach
						</ul>
					@endif


                    {!! Form::open(['route' => ['prefeituras.update', $prefeitura->id], 'method' => 'put']) !!}

                        <div class="row">
                            <div class="col-md-5 col-md-offset-1">
                                <div class="form-group{{ $errors->has('cnpj') ? ' has-error' : '' }} form-success label-floating">
                                    {!! Form::label('cnpj', 'CNPJ', ['class' => 'control-label']) !!}
                                    {!! Form::text('cnpj', $prefeitura->cnpj, ['class' => 'form-control', 'required' => 'required', 'id' => 'cnpj']) !!}
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group{{ $errors->has('cidade') ? ' has-error' : '' }} form-success label-floating">
                                    {!! Form::label('cidade', 'Cidade', ['class' => 'control-label']) !!}
                                    {!! Form::select('cidade', \App\Cidades::orderBy('nome')->pluck('nome', 'id')->toArray(), $prefeitura->cidade_id, ['class' => 'form-control'])  !!}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-5 col-md-offset-1">
                                <div class="form-group{{ $errors->has('endereco') ? ' has-error' : '' }} form-success label-floating">
                                    {!! Form::label('endereco', 'Endereço', ['class' => 'control-label']) !!}
                                    {!! Form::text('endereco', $prefeitura->endereco, ['class' => 'form-control', 'required' => 'required']) !!}
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group form-success label-floating">
                                    {!! Form::label('numero', 'Número', ['class' => 'control-label']) !!}
                                    {!! Form::number('numero', $prefeitura->numero,  ['class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>

                        {!! Form::submit('Editar Prefeitura', ['class' => 'btn btn-success pull-right']) !!}
                        <a href="{{ route('prefeituras') }}" class="btn btn-default pull-right">Voltar</a>
                        
                        <div class="clearfix"></div>

                    {!! Form::close() !!}

                </div>
            </div>
        </div>

	</div>
@endsection