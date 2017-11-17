@extends('main')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-1">
            <div class="card">
                <div class="card-header" data-background-color="green">
                    <h4 class="title">Novo Usuário</h4>
                    <p class="category">Preencha todos os campos</p>
                </div>
                <div class="card-content">
                    <form method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="row">
                            <div class="col-md-5 col-md-offset-1">
                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} form-success label-floating">
                                    <label class="control-label">Nome</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} form-success label-floating">
                                    <label class="control-label">E-mail</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5 col-md-offset-1">
                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} form-success label-floating">
                                    <label class="control-label">Senha</label>
                                    <input type="password" class="form-control" id="password" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group form-success label-floating">
                                    <label class="control-label">Confirmação de Senha</label>
                                    <input type="password" class="form-control" id="password-confirm" name="password_confirmation" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5 col-md-offset-1">
                                <div class="form-group form-success label-floating">
                                    {!! Form::label('perfil', 'Perfil', ['class' => 'control-label']) !!}
                                    {!! Form::select('perfil', \App\Perfil::orderBy('descricao')->pluck('descricao', 'id')->toArray(), null, ['class' => 'form-control', 'required' => 'required'])  !!}
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group form-success label-floating">
                                     <div class="form-group form-success label-floating">
                                        {!! Form::label('cidade', 'Cidade', ['class' => 'control-label']) !!}
                                        {!! Form::select('cidade', \App\Cidades::orderBy('nome')->pluck('nome', 'id')->toArray(), null, ['class' => 'form-control', 'required' => 'required'])  !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success pull-right">Criar Usuário</button>
                        <div class="clearfix"></div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
