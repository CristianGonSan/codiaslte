@extends('adminlte::page')

@section('plugins.Datatables', true)
@section('plugins.DatatablesResponsive', true)
@section('plugins.DatatablesButtons', true)

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
            <li class="breadcrumb-item active">Productos</li>
        </ol>
        <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Nuevo Producto
        </a>
    </nav>
    @include('layouts.alert')
@endsection

@section('content')

    <style>
        table td {
            max-width: 200px;
            white-space: nowrap;
            text-overflow: ellipsis;
            word-break: break-all;
            overflow: hidden;
        }
    </style>

    @php
        $heads = [
            ['label' => '-', 'no-export' => true],
            'ID',
            'Nombre',
            'Código',
            'Unidad',
            'Precio',
            'Fecha',
            ['label' => 'Ver', 'no-export' => true]];

        $config = [
            'pagingType' => 'numbers',
            'processing' => true,
            'serverSide' => true,
            'responsive' => true,
            'ajax' => route('products.datatable'),
            'order' => [
                    [1, 'desc']
                ],
            'columnDefs' => [
                [
                    'className' => 'dtr-control',
                    'orderable' => false,
                    'searchable' => false,
                    'targets' => 0
                ],
            ],
            'columns' => [
                ['data'=> null, 'defaultContent' => ''],
                ['data' => 'id', 'name' => 'id', 'searchable' => false, 'responsivePriority' => 1000],
                ['data' => 'name', 'name' => 'name', 'responsivePriority' => 4],
                ['data' => 'code', 'name' => 'code', 'responsivePriority' => 1],
                ['data' => 'unit', 'name' => 'unit', 'searchable' => false, 'responsivePriority' => 3],
                ['data' => 'price', 'name' => 'price', 'searchable' => false, 'responsivePriority' => 2],
                ['data' => 'created_at', 'name' => 'created_at', 'searchable' => false, 'responsivePriority' => 5],
                ['data' => 'action', 'name' => 'action', 'orderable' => false, 'searchable' => false, 'responsivePriority' => -1],
            ],
        ];
    @endphp

    <x-adminlte-card >
        <x-adminlte-datatable id="table1" :heads="$heads" :config="$config"
                              compressed with-buttons hoverable with-footer/>
    </x-adminlte-card>
@endsection
