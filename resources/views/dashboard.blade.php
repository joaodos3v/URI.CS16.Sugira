@extends('main');
@section('title_page', 'Dashboard')

@section('content')
	<div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header" data-background-color="green">
                    <i class="material-icons">done_all</i>
                </div>
                <div class="card-content">
                    <p class="category">Concluídas</p>
                    <h3 class="title">VAlor Aqui</h3>
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
                    <p class="category">Em Andamento / Abertas</p>
                    <h3 class="title">Valor Aqui
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
                    <p class="category">Cancelas</p>
                    <h3 class="title">Valor Aqui</h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons">face</i> Sugira Team
                    </div>
                </div>
            </div>
        </div>
@endsection