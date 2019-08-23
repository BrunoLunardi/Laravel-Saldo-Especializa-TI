@extends('adminlte::page')

<!-- Titulo da página -->
@section('title', 'Nova Recarga')

<!-- Área para uma seção usada como título do dashboard -->
@section('content_header')
    <h1>Fazer Recarga</h1>

    <ol class="breadcrumb">
            <li><a href="">Dashboard</a></li>
            <li><a href="">Saldo</a></li>
            <li><a href="">Depositar</a></li>
        </ol>

@stop

<!-- Conteúdo da página -->
@section('content')

<div class="box">
    <div class="box-header">
        <h3>Fazer Recarga</h3>
    </div>
    <div class="box-body">

        <!-- dados serão enviados para a rota deposit.store -->
        <form method="POST" action="{{ route('deposit.store') }}">

            <!-- TOken para não dar erro de envio de dados -->
            {!! csrf_field() !!}

            <div class="form-group">
                <input type="text" name="value" placeholder="Valor Recarga" class="form-control">
            </div>
            <div class="form-group">
                    <button type="submit" class="btn btn-success">Recarregar</button>
                </div>            
        </form>
    </div>
</div>

@stop