@extends('adminlte::page')

<!-- Titulo da página -->
@section('title', 'Saldo')

<!-- Área para uma seção usada como título do Saldo -->
@section('content_header')
    <h1>Saldo</h1>

    <ol class="breadcrumb">
        <li><a href="">Dashboard</a></li>
        <li><a href="">Saldo</a></li>
    </ol>

@stop

<!-- Conteúdo da página -->
@section('content')
    <div class="box">
        <div class="box-header">
        <!-- Botão que acessará a rota deposit que foi renomeada para balance.deposit em web.php -->
        <a href="{{ route('balance.deposit') }}" class="btn btn-primary">
                <i class="fas fa-cart-plus"></i>
                Recarregar
            </a>
            <!-- só exibe este botão se o saldo for maior que zero -->
            @if($amount > 0)
                <!-- rota para recarga -->
                <a href="{{ route('balance.withdraw') }}" class="btn btn-danger">
                    <i class="fas fa-cart-arrow-down"></i>
                    Sacar
                </a>
            @endif()

        </div>
        <div class="box-body">
            <!-- include para verificações de erro (resources/views/admin/includes) -->
            @include('admin.includes.alerts')
                <div class="small-box bg-green">
                    <div class="inner">
                        <!-- variável $amount passada pelo controller BaanceController -->
                        <!-- number_format (valor, casas apos virgula, ponto ou vigula como separador, espaço ou não na cada de milhares) -->
                        <h3>R$ {{number_format($amount,2, ',', '')}}</h3>
                    </div>
                    <div class="icon">
                        <i class="ion ion-cash"></i>
                    </div>
                    <a href="#" class="small-box-footer">Histórico<i class="fas fa-info-square"></i></a>
                </div>
        </div>
    </div>
@stop