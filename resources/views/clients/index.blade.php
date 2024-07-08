@extends('adminlte::page')

@section('plugins.Datatables', true)
@section('plugins.DatatablesResponsive', true)
@section('plugins.DatatablesButtons', true)

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
            <li class="breadcrumb-item active">Clientes</li>
        </ol>
        <a href="{{ route('clients.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Nuevo Cliente
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
            'Compañía',
            'Nombre',
            'Teléfono',
            'Email',
            'Dirección',
            'Ciudad',
            'Estado',
            'Pais',
            'Codio Postal',
            'Clave RFC',
            'Fecha',
            ['label' => 'Ver', 'no-export' => true]];

        $config = [
            'pagingType' => 'numbers',
            'processing' => true,
            'serverSide' => true,
            'responsive' => true,
            'ajax' => route('clients.datatable'),
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
                ['data' => 'company_name', 'name' => 'company_name', 'responsivePriority' => 4],
                ['data' => 'name', 'name' => 'name', 'responsivePriority' => 1],
                ['data' => 'email', 'name' => 'email', 'searchable' => false, 'responsivePriority' => 3],
                ['data' => 'phone', 'name' => 'phone', 'searchable' => false, 'responsivePriority' => 2],
                ['data' => 'address', 'name' => 'address', 'searchable' => false, 'responsivePriority' => 5],
                ['data' => 'city', 'name' => 'city', 'searchable' => false, 'responsivePriority' => 5],
                ['data' => 'state', 'name' => 'state', 'searchable' => false, 'responsivePriority' => 5],
                ['data' => 'country', 'name' => 'country', 'searchable' => false, 'responsivePriority' => 5],
                ['data' => 'postal_code', 'name' => 'postal_code', 'searchable' => false, 'responsivePriority' => 5],
                ['data' => 'rfc_id', 'name' => 'rfc_id', 'searchable' => false, 'responsivePriority' => 5],
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
