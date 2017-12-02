@extends('main');
@section('title_page', 'Dashboard')

@section('content')
	<div class="row">

        @if (session('sucesso'))
            <input type="hidden" name="status" id="status" value="sucesso">
        @endif


        <script type="text/javascript">
            // Para mostrar mensagens quando a rota foi chamada, com parâmetros
            var status = $("#status").val();
            if(status == "Sucesso_Inserir") {
                showNotification('bottom','right', 'success', "Perfil criado com sucesso!", 'check_circle') ;
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

        <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header" data-background-color="green">
                    <i class="material-icons">done_all</i>
                </div>
                <div class="card-content">
                    <p class="category">Concluídas</p>
                    {{-- <h3 class="title">{{ count($concluidas) }}</h3> --}}
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons">face</i> Sugira Team
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header" data-background-color="orange">
                    <i class="material-icons">build</i>
                </div>
                <div class="card-content">
                    <p class="category">Em Andamento</p>
                    {{-- <h3 class="title">{{ count($em_andamento) }} --}}
                    </h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons">face</i> Sugira Team
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header" data-background-color="red">
                    <i class="material-icons">info_outline</i>
                </div>
                <div class="card-content">
                    <p class="category">Abertas</p>
                    {{-- <h3 class="title">{{ count($abertas) }}</h3> --}}
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons">face</i> Sugira Team
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card card-plain">
                <div class="card-header" data-background-color="green">
                    <h4 class="title">Sugestões</h4>
                    {{-- <p class="category">Estes são os problemas dos habitantes da cidade <b>{{$cidade->nome}}</b></p> --}}
                </div>
                <div class="card-content table-responsive">
                    <table class="table table-hover table-responsive">
                        <thead>
                            <th>#</th>
                            <th>Descrição</th>
                            <th>Status</th>
                            <th>Endereço</th>
                            <th>Gênero</th>
                            <th>Classificação</th>
                            <th></th>
                        </thead>
                       {{--  <tbody>
                            @foreach($sugestoes as $sug)
                                <tr>
                                    <td> {{ $sug->id }} </td>
                                    <td> {{ $sug->descricao }} </td>
                                    <td> 
                                        <center>
                                            @if($sug->status == 'Aberta')
                                                <i class="material-icons" data-background-color="red">info_outline</i>
                                            @elseif ($sug->status == 'Em Andamento')
                                                <i class="material-icons" data-background-color="orange">build</i>
                                            @elseif ($sug->status == 'Concluida')
                                                <i class="material-icons" data-background-color="green">done_all</i>
                                            @endif
                                        </center>
                                    </td>
                                    <td> {{ $sug->endereco }}, {{ $sug->numero }} </td>
                                    <td> {{ $sug->classificacao }} </td>
                                    <td> {{ $sug->genero }} </td>
                                    <td>
                                        {!! Form::open(['route' => 'dashboard.edit', 'method' => 'post' ]) !!}
                                            <input type="hidden" name="id" value="{{$sug->id}}">
                                            <button type="submit" class="btn btn-sm btn-info btn-round"> Editar</button>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody> --}}
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection