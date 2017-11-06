@extends('main');
@section('title_page', 'Gêneros');

@section('content')
    <div class="row">
        @if (session('sucesso_inserir'))
            <input type="hidden" name="status" id="status" value="Sucesso_Inserir">
        @endif

        <script type="text/javascript">
            // Para mostrar mensagens após atualizar a página
            var response = window.localStorage.getItem('response');
            if(response) {
                if(response == 'Sucesso_Excluir') {
                    localStorage.removeItem('response');
                    showNotification('bottom','right', 'success', "Gênero deletado com sucesso!", 'check_circle') ;
                } else {
                    localStorage.removeItem('response');
                    showNotification('bottom','right', 'danger', "Problema ao deletar gênero!", 'highlight_off') ;
                }
            }

            // Para mostrar mensagens quando a rota foi chamada, com parâmetros
            var status = $("#status").val();
            if(status == "Sucesso_Inserir") {
                showNotification('bottom','right', 'success', "Gênero criado com sucesso!", 'check_circle') ;
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
            function confirmDelete(id_genero, genero){
                $.ajaxSetup({
                    headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
                });

                swal({
                  title: "Tem certeza?",
                  text: "O gênero "+ genero +" será deletado!",
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
                        url: "{{ url("generos/exclude/") }}/"+id_genero,
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
			  		<div class="alert alert-success" role="alert">
					  Você pode criar um <strong>novo gênero</strong> ao lado!
					</div>
			  	</div>
			  	{!! Form::open(['route' => 'generos.store']) !!}
				  	<div class="col-md-5 col-md-offset-1">
					    <div class="form-group form-success label-floating">
		                    <label class="control-label">Descrição do Gênero</label>
		                    <input type="text" class="form-control" id="descricao" name="descricao" required>
		                </div>
				  	</div>
				  	<div class="col-md-2">
				  		<button type="submit" class="btn btn-success">Criar Gênero</button>
				  	</div>
				  	{!! Form::close() !!}
			  </div>
			</div>
		</div>

		<div class="col-md-12">
            <div class="card card-plain">
                <div class="card-header" data-background-color="green">
                    <h4 class="title">Gêneros</h4>
                    <p class="category">Estes são os gêneros já cadastrados no sistema</p>
                </div>
                <div class="card-content table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <th>#</th>
                            <th>Descrição</th>
                            <th>Ações</th>
                        </thead>
                        <tbody>
                            @foreach($generos as $g)
                                <tr>
                                    <td> {{ $g->id }} </td>
                                    <td> {{ $g->descricao }} </td>
                                    <td>
                                        <a href="#pablo" class="btn btn-sm btn-info btn-round">Editar</a>
                                        <a class="btn btn-sm btn-danger btn-round" onClick="confirmDelete('{{ $g->id }}', '{{ $g->descricao }}')">Deletar</a>
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