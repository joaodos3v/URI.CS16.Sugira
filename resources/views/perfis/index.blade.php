@extends('main');
@section('title_page', 'Perfis de Usuários');

@section('content')
	<div class="row">
		@if (session('sucesso_inserir'))
            <input type="hidden" name="status" id="status" value="Sucesso_Inserir">
        @elseif (session('sucesso_editar'))
            <input type="hidden" name="status" id="status" value="Sucesso_Editar">
        @elseif (session('sucesso_permissoes'))
            <input type="hidden" name="status" id="status" value="Sucesso_Permissoes">
        @endif

        <script type="text/javascript">
        	// Para mostrar mensagens após atualizar a página
            var response = window.localStorage.getItem('response');
            if(response) {
                if(response == 'Sucesso_Excluir') {
                    localStorage.removeItem('response');
                    showNotification('bottom','right', 'success', "Perfil deletado com sucesso!", 'check_circle') ;
                } else {
                    localStorage.removeItem('response');
                    showNotification('bottom','right', 'danger', "Problema ao deletar perfil!", 'highlight_off') ;
                }
            }

            // Para mostrar mensagens quando a rota foi chamada, com parâmetros
            var status = $("#status").val();
            if(status == "Sucesso_Inserir") {
                showNotification('bottom','right', 'success', "Perfil criado com sucesso!", 'check_circle') ;
            } else if(status == "Sucesso_Editar") {
                showNotification('bottom','right', 'success', "Perfil editado com sucesso!", 'check_circle') ;
            } else if(status == "Sucesso_Permissoes") {
                showNotification('bottom','right', 'success', "Permissões atualizadas com sucesso!", 'check_circle') ;
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

            // Função que irá permitir edição de perfil
            function editaPerfil(id_perfil, perfil) {
                // Form de Edição
                $("#alert_edit").show();
                $("#input_edit").show();
                $("#btn_edit").show();
                $("#descricao_edit").val(perfil);
                $(".form-edit").addClass('is-focused');                
                $("#id_perfil").val(id_perfil);

                // Form de Criação
                $("#alert_create").hide();
                $("#input_create").hide();
                $("#btn_create").hide();
            }

            // Função que irá abrir S.A. para confirmar se deseja, realmente, deletar gênero
            function confirmDelete(id_perfil, perfil){
                $.ajaxSetup({
                    headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
                });

                swal({
                  title: "Tem certeza?",
                  text: "O perfil "+ perfil +" será deletado!",
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
                        url: "{{ url("perfil/exclude/") }}/"+id_perfil,
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
			<div class="card">
			  <div class="card-block">
			  	<div class="col-md-3">
			  		<div class="alert alert-success" role="alert" id="alert_create">
					  Você pode criar um <strong>novo perfil</strong> ao lado!
					</div>
                    <div class="alert alert-info" role="alert" id="alert_edit" style="display: none">
                      Você pode <strong>editar</strong> o perfil escolhido ao lado!
                    </div>
			  	</div>
			  	{{-- Form para Criação --}}
                {!! Form::open(['route' => 'perfis.store']) !!}
				  	<div class="col-md-5 col-md-offset-1" id="input_create">
					    <div class="form-group form-success label-floating">
		                    <label class="control-label">Descrição do Perfil</label>
		                    <input type="text" class="form-control" id="descricao" name="descricao" required>
		                </div>
				  	</div>
				  	<div class="col-md-2" id="btn_create">
				  		<button type="submit" class="btn btn-success">Criar Perfil</button>
				  	</div>
				{!! Form::close() !!}
                {{-- Form para Edição --}}
                {!! Form::open(['route' => ['perfis.update'], 'method' => 'put']) !!}
                    <input type="hidden" class="form-control" id="id_perfil" name="id_perfil">
                    <div class="col-md-5 col-md-offset-1" id="input_edit" style="display: none">
                        <div class="form-group form-success label-floating form-edit">
                            <label class="control-label">Descrição do Perfil</label>
                            <input type="text" class="form-control" id="descricao_edit" name="descricao" required>
                        </div>
                    </div>
                    <div class="col-md-2" id="btn_edit" style="display: none">
                        <button type="submit" class="btn btn-info">Editar Perfil</button>
                    </div>
                {!! Form::close() !!}
			  </div>
			</div>
		</div>

		<div class="col-md-12">
            <div class="card card-plain">
                <div class="card-header" data-background-color="green">
                    <h4 class="title">Perfis de Usuários</h4>
                    <p class="category">Estes são os perfis já cadastrados no sistema</p>
                </div>
                <div class="card-content table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <th>#</th>
                            <th>Descrição</th>
                            <th>Ações</th>
                        </thead>
                        <tbody>
                            @foreach($perfis as $p)
                                <tr>
                                    <td> {{ $p->id }} </td>
                                    <td> {{ $p->descricao }} </td>
                                    <td>
                                        <a href="{{ route('perfis.permissions', ['id' => $p->id]) }}" class="btn btn-sm btn-warning btn-round">Permissões</a>
                                        <a class="btn btn-sm btn-info btn-round" onClick="editaPerfil('{{ $p->id }}', '{{ $p->descricao }}')">Editar</a>
                                        <a class="btn btn-sm btn-danger btn-round" onClick="confirmDelete('{{ $p->id }}', '{{ $p->descricao }}')">Deletar</a>
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