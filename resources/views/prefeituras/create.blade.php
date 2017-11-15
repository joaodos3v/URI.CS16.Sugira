@extends('main');
@section('title_page', 'Criando Nova Prefeitura')

@section('content')
	<div class="row">
		<script type="text/javascript">
			$(document).ready(function(){	
				$("#cnpj").mask("99.999.999/9999-99");
			});
		</script>
		
		<div class="col-md-8 col-md-offset-1">
            <div class="card">
                <div class="card-header" data-background-color="green">
                    <h4 class="title">Nova Prefeitura</h4>
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

                    {!! Form::open(['route' => 'prefeituras.store']) !!}

                        <div class="row">
                            <div class="col-md-5 col-md-offset-1">
                                <div class="form-group{{ $errors->has('cnpj') ? ' has-error' : '' }} form-success label-floating">
                                    {!! Form::label('cnpj', 'CNPJ', ['class' => 'control-label']) !!}
                                    {!! Form::text('cnpj', old('cnpj'), ['class' => 'form-control', 'required' => 'required', 'id' => 'cnpj']) !!}
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group{{ $errors->has('cidade') ? ' has-error' : '' }} form-success label-floating">
                                    {!! Form::label('cidade', 'Cidade', ['class' => 'control-label']) !!}
                                    {!! Form::select('cidade', \App\Cidades::orderBy('nome')->pluck('nome', 'id')->toArray(), null, ['class' => 'form-control'])  !!}
                                    {{-- \App\Habito::orderBy('nome')->pluck('nome', 'id')->toArray() --}}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-5 col-md-offset-1">
                                <div class="form-group{{ $errors->has('endereco') ? ' has-error' : '' }} form-success label-floating">
                                    {!! Form::label('endereco', 'Endereço', ['class' => 'control-label']) !!}
                                    {!! Form::text('endereco', old('endereco'), ['class' => 'form-control', 'required' => 'required']) !!}
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group form-success label-floating">
                                    {!! Form::label('numero', 'Número', ['class' => 'control-label']) !!}
                                    {!! Form::number('numero', null,  ['class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>

                        {!! Form::submit('Criar Prefeitura', ['class' => 'btn btn-success pull-right']) !!}
                        <div class="clearfix"></div>

                    {!! Form::close() !!}

                    </form>
                </div>
            </div>
        </div>

	</div>
@endsection