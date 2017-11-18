@extends('main');
@section('title_page', "Usuários");

@section('content')
	<div class="container">
        @if (session('Sucesso_Edicao_Privada'))
            <input type="hidden" name="status" id="status" value="Sucesso_Edicao_Privada">
        @endif

		<script type="text/javascript">
			// Para mostrar mensagens após atualizar a página
            var response = window.localStorage.getItem('response');
            if(response) {
                if(response == 'Sucesso_Excluir') {
                    localStorage.removeItem('response');
                    showNotification('bottom','right', 'success', "Usuário deletado com sucesso!", 'check_circle') ;
                }
            }

            // Para mostrar mensagens quando a rota foi chamada, com parâmetros
            var status = $("#status").val();
            if(status == "Sucesso_Edicao_Privada") {
                showNotification('bottom','right', 'success', "Usuário editado com sucesso!", 'check_circle') ;
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

			// Função que irá abrir S.A. para confirmar se deseja, realmente, deletar gênero
            function confirmDelete(id_user, nome){
                $.ajaxSetup({
                    headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
                });

                swal({
                  title: "Tem certeza?",
                  text: "O usuário "+ nome +" será deletado!",
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
                        url: "{{ url("user/exclude/") }}/"+id_user,
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
			                            <td> {{ $user->perfil }} </td>
			                            <td>
			                                <a href="{{ route('usuarios.edit.private', ['id' => $user->id]) }}" class="btn btn-sm btn-info btn-round">Editar</a>
			                                <a class="btn btn-sm btn-danger btn-round" onClick="confirmDelete('{{$user->id}}', '{{$user->name}}')">Deletar</a>
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