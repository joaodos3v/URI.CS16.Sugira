@extends('main');
@section('title_page', 'Prefeituras')

@section('content')
	<div class="row">
        @if (session('sucesso'))
            <input type="hidden" name="status" id="status" value="sucesso">
        @elseif (session('sucesso_edicao'))
            <input type="hidden" name="status" id="status" value="sucesso_edicao">
        @endif

        <script type="text/javascript">
            // Para mostrar mensagens após atualizar a página
            var response = window.localStorage.getItem('response');
            if(response) {
                if(response == 'Sucesso_Excluir') {
                    localStorage.removeItem('response');
                    showNotification('bottom','right', 'success', "Prefeitura deletada com sucesso!", 'check_circle') ;
                } else {
                    localStorage.removeItem('response');
                    showNotification('bottom','right', 'danger', "Problema ao deletar prefeitura!", 'highlight_off') ;
                }
            }

            // Para mostrar mensagens quando a rota foi chamada, com parâmetros
            var status = $("#status").val();
            if(status == "sucesso") {
                showNotification('bottom','right', 'success', "Nova Prefeitura criada com sucesso!", 'check_circle') ;
            } else if(status == "sucesso_edicao") {
                showNotification('bottom','right', 'success', "Prefeitura editada com sucesso!", 'check_circle') ;
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

            // Função que irá abrir S.A. para confirmar se deseja, realmente, deletar a prefeitura
            function confirmDelete(idPref, cidade){
                $.ajaxSetup({
                    headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
                });

                swal({
                  title: "Tem certeza?",
                  text: "Todos os dados da prefeitura de "+ cidade +" serão perdidos!",
                  icon: "warning",
                  buttons:{
                    cancel: {
                        text: "Cancelar",
                        value: null,
                        visible: true,
                        className: "",
                        closeModal: true,
                      },
                      confirm: {
                        text: "Deletar",
                        value: true,
                        visible: true,
                        className: "",
                        closeModal: true
                      }
                  },
                }).then((confirm) => {
                  if (confirm) {
                    $.ajax({
                        type: 'GET',
                        url: "{{ url("prefeituras/exclude/") }}/"+idPref,
                        dataType: 'JSON',
                        success: function (data) {
                            window.localStorage.setItem('response', data.response)
                            location.reload();
                        }, error: function (err){
                            console.log(err.responseText);
                        }
                    });
                  }
                });
            }
        </script>
		
		<div class="col-md-12">
            <div class="card card-plain">
                <div class="card-header row" data-background-color="green">
                    <div class="col-md-8">
	                    <h4 class="title">Prefeituras</h4>
	                    <p class="category">Estas são as prefeituras já cadastradas no sistema</p>
                    </div>
                    <div class="col-md-2 pull-right" style="margin-right: 2%;">
                    	<a href="{{ route('prefeituras.create') }}" class="btn btn-darkcyan btn-round">Nova Prefeitura</a>
                    </div>
                </div>
                <div class="card-content table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <th>#</th>
                            <th>CNPJ</th>
                            <th>Cidade</th>
                            <th>Endereço</th>
                            <th>Ações</th>
                        </thead>
                        <tbody>
                            @foreach($prefeituras as $pref)
                                <tr>
                                    <td> {{ $pref->id }} </td>
                                    <td> {{ $pref->cnpj }} </td>
                                    <td> {{ $pref->cidade }} </td>
                                    <td> {{ $pref->endereco }}, {{ $pref->numero }} </td>
                                    <td>
                                        <a href="{{ route('prefeituras.edit', ['id' => $pref->id]) }}" class="btn btn-sm btn-info btn-round">Editar</a>
                                        <a class="btn btn-sm btn-danger btn-round" onClick="confirmDelete('{{ $pref->id }}', '{{ $pref->cidade }}')">Deletar</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

	</div>
@endsection