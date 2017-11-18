@extends('main')
@section('title_page', "Editando Usuário - $user->name");

@section('content')
<div class="container">
    <div class="row">
        <script type="text/javascript">
            $(function(){
                if($("#select_perfis").val() == 1)
                    $("#div_cidade").hide();

                // Sempre que ocorre uma mudança no select de perfis, verifica se é administrador ou não
                $(document).on('change', '#select_perfis', function(e) {
                    if($("#select_perfis").val() == 1)
                        $("#div_cidade").hide();
                    else 
                        $("#div_cidade").show();
                });

            });
        </script>


        <div class="col-md-8 col-md-offset-1">
            <div class="card">
                <div class="card-header" data-background-color="green">
                    <h4 class="title">Editando Usuário - <b>{{ $user->name }}</b></h4>
                    <p class="category">Realzie as alterações que desejar</p>
                </div>
                <div class="card-content">
                    {!! Form::open(['route' => ['usuarios.update.private', $user->id], 'method' => 'put']) !!}

                        <div class="row">
                            <div class="col-md-5 col-md-offset-1">
                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} form-success label-floating">
                                    <label class="control-label">Nome</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5 col-md-offset-1">
                                <div class="form-group form-success label-floating">
                                    {!! Form::label('perfil', 'Perfil', ['class' => 'control-label']) !!}
                                    {!! Form::select('perfil', \App\Perfil::orderBy('descricao')->pluck('descricao', 'id')->toArray(), $user->perfil_id, ['class' => 'form-control', 'required' => 'required', 'id' => 'select_perfis'])  !!}
                                </div>
                            </div>
                            <div class="col-md-5" id="div_cidade">
                                <div class="form-group form-success label-floating">
                                     <div class="form-group form-success label-floating">
                                        {!! Form::label('cidade_pref', 'Prefeitura', ['class' => 'control-label']) !!}
                                        {!! Form::select('cidade_pref', \App\Prefeituras::orderBy('cidade')->pluck('cidade', 'id')->toArray(), $user->prefeitura_id, ['class' => 'form-control'])  !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success pull-right">Editar Usuário</button>
                        <a href="{{ route('usuarios') }}" class="btn btn-default pull-right">Voltar</a>
                        
                        <div class="clearfix"></div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
