@extends('main')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-1">
            <div class="card">
                <div class="card-header" data-background-color="green">
                    <h4 class="title">Alterar Usuário  -  <b>{{ Auth::user()->name }}</b></h4>
                    <p class="category">Preencha todos os campos</p>
                </div>

                @if (session('sucesso'))
                    <input type="hidden" name="status" id="status" value="sucesso">
                @elseif (session('confirmacao_senha_invalida'))
                    <input type="hidden" name="status" id="status" value="confirmacao_senha_invalida">
                @elseif (session('tamanho_minimo'))
                    <input type="hidden" name="status" id="status" value="tamanho_minimo">
                @elseif (session('senha_atual_invalida'))
                    <input type="hidden" name="status" id="status" value="senha_atual_invalida">
                @endif

                <script type="text/javascript">
                    // Para mostrar mensagens quando a rota foi chamada, com parâmetros
                    var status = $("#status").val();
                    if(status == "sucesso") {
                        showNotification('bottom','right', 'success', "Senha alterada com sucesso!", 'check_circle') ;
                    } else if(status == "confirmacao_senha_invalida") {
                        showNotification('bottom','right', 'warning', "Senha e confirmação de senha não são iguais!", 'highlight_off') ;
                    } else if(status == "tamanho_minimo") {
                        showNotification('bottom','right', 'warning', "A nova senha deve possuir, no mínimo, 6 caracteres!", 'highlight_off') ;
                    } else if(status == "senha_atual_invalida") {
                        showNotification('bottom','right', 'danger', "A senha atual não é igual à senha digitada!", 'highlight_off') ;
                    }


                    // Função para mostrar notificações na tela. Tipos Disponíveis = ['info', 'success', 'warning', 'danger'];
                    function showNotification(from, align, type, message, icon) {
                        $.notify(
                        {
                            icon: icon,
                            message: message
                        }, {
                            type: type,
                            timer: 2500,
                            placement: {
                                from: from,
                                align: align
                            }
                        });
                    }
                </script>

                <div class="card-content">
                    <form method="POST" action="{{ route('usuarios.update') }}">
                        {{ csrf_field() }}

                        <div class="row">
                            <div class="col-md-5 col-md-offset-1">
                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} form-success label-floating">
                                    <label class="control-label">Nome</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}" required autofocus>

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
                                    <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}" required disabled="disabled" readonly="readonly">

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
                                <div class="form-group form-success label-floating">
                                    <label class="control-label">Senha Atual</label>
                                    <input type="password" class="form-control" id="senha_atual" name="senha_atual" required>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} form-success label-floating">
                                    <label class="control-label">Nova Senha</label>
                                    <input type="password" class="form-control" id="nova_senha" name="nova_senha" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                         <div class="row">
                            <div class="col-md-5 col-md-offset-1">
                                <div class="form-group form-success label-floating">
                                    <label class="control-label">Confirmação de Nova Senha</label>
                                    <input type="password" class="form-control" id="novaSenha_confirm" name="novaSenha_confirm" required>
                                </div>
                            </div>
                            <duv class="col-md-4 col-md-offset-1">
                                <button type="submit" class="btn btn-success pull-right">Alterar Usuário</button>
                            </duv>
                        </div>
                        <div class="clearfix"></div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection