@extends('adminlte::page')

<!-- Titulo da página -->
@section('title', 'Nova Recarga')

<!-- Área para uma seção usada como título do dashboard -->
@section('content_header')
    <h1>Fazer Retirada</h1>

    <ol class="breadcrumb">
            <li><a href="">Dashboard</a></li>
            <li><a href="">Saldo</a></li>
            <li><a href="">Retirada</a></li>
        </ol>

@stop

<!-- Conteúdo da página -->
@section('content')

<div class="box">
    <div class="box-header">
        <h3>Fazer Retirada</h3>
    </div>
    <div class="box-body">

    <!-- Verificação de erros do campo value. Esta verificação e feita no BalanceController -->
    <!-- Que invoca o FormRequest app/Requests/MoneyValidationFormRequest -->
    <!-- aquivo de inclusão está em resources/views/admin/includes -->
    @include('admin.includes.alerts')

        <!-- dados serão enviados para a rota withdrawn.store -->
        <form method="POST" action="{{ route('withdraw.store') }}">

            <!-- TOken para não dar erro de envio de dados -->
            {!! csrf_field() !!}

            <div class="form-group">
                <input type="text" name="value" placeholder="Valor Retirada" class="form-control">
            </div>
            <div class="form-group">
                    <button type="submit" class="btn btn-success">Sacar</button>
                </div>            
        </form>
    </div>
</div>

@stop