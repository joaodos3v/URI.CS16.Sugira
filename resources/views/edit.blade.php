@extends('main');
@section('title_page', "Editando Sugestão: #$sugestao->id")

@section('content')
	<div class="row">
       <div class="col-md-8 col-md-offset-1">
            <div class="card">
                <div class="card-header" data-background-color="green">
                    <h4 class="title">Editando Sugestão - #{{$sugestao->id }}</h4>
                    <p class="category">Altere o status desta sugestão</p>
                </div>
                <div class="card-content">
                	@if($errors->any())
						<ul class="alert alert-danger">
							@foreach($errors->all() as $error)
								<li> {{ $error }} </li>
							@endforeach
						</ul>
					@endif

					 <div class="row">
                        <div class="col-md-5 col-md-offset-1">
                            <div class="form-group{{ $errors->has('descricao') ? ' has-error' : '' }} form-success label-floating">
                                {!! Form::label('descricao', 'Descrição', ['class' => 'control-label']) !!}
                                {!! Form::textarea('descricao', $sugestao->descricao, ['class' => 'form-control', 'disabled' => 'disabled', 'readonly' => 'readonly', 'style' => 'height: 65px']) !!}
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group{{ $errors->has('endereco') ? ' has-error' : '' }} form-success label-floating">
                                {!! Form::label('endereco', 'Endereço', ['class' => 'control-label']) !!}
                                {!! Form::text('endereco', $sugestao->endereco . ',' . $sugestao->numero, ['class' => 'form-control', 'disabled' => 'disabled', 'readonly' => 'readonly']) !!}
                            </div>
                            <div class="form-group{{ $errors->has('classificacao') ? ' has-error' : '' }} form-success label-floating">
                                {!! Form::label('classificacao', 'Classificação', ['class' => 'control-label']) !!}
                                {!! Form::text('classificacao', $sugestao->classificacao, ['class' => 'form-control', 'disabled' => 'disabled', 'readonly' => 'readonly']) !!}
                            </div>
                        </div>
                    </div>
                    <hr style="border: 0.1px dashed #C6C6C7">

                    {!! Form::open(['route' => ['dashboard.update', $sugestao->id], 'method' => 'put']) !!}

                        <div class="row">
                            <div class="col-md-5 col-md-offset-1">
                                <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }} form-success label-floating">
                                    {!! Form::label('status', 'Status', ['class' => 'control-label']) !!}
                                    {!! Form::select('status', $status, $sugestao->status, ['class' => 'form-control'])  !!}
                                </div>
                            </div>
                        </div>

                        {!! Form::submit('Editar Status', ['class' => 'btn btn-success pull-right']) !!}
                        <a href="{{ route('dashboard') }}" class="btn btn-default pull-right">Voltar</a>
                        
                        <div class="clearfix"></div>

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
@endsection