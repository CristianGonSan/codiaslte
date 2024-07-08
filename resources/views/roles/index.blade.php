@extends('adminlte::page')

@section('plugins.Datatables', true)
@section('plugins.DatatablesResponsive', true)
@section('plugins.DatatablesButtons', true)

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
            <li class="breadcrumb-item active">Roles</li>
        </ol>
        <a href="{{ route('roles.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Agregar Rol
        </a>
    </nav>
    @include('layouts.alert')
@stop

@section('content')
    @php
        $heads = [
            ['label' => '-', 'no-export' => true],
            'ID',
            'Nombre',
            'Fecha',
            ['label' => 'Ver', 'no-export' => true]];

        $config = [
            'pagingType' => 'numbers',
            'processing' => true,
            'serverSide' => true,
            'responsive' => true,
            'ajax' => route('roles.datatable'),
            'order' => [
                    [1, 'desc']
                ],
            'columnDefs' => [
                [
                    'className' => 'dtr-control',
                    'orderable' => false,
                    'searchable' => false,
                    'targets' => 0
                ]
            ],
            'columns' => [
                ['data'=> null, 'defaultContent' => ''],
                ['data'=> 'id', 'name'=> 'id', 'searchable' => false],
                ['data'=> 'name', 'name'=> 'name'],
                ['data'=> 'created_at', 'name'=> 'created_at', 'searchable' => false],
                ['data' => 'action', 'name' => 'action', 'orderable' => false, 'searchable' => false],
            ],
        ];
    @endphp

    <x-adminlte-card>
        <x-adminlte-datatable id="table1" :heads="$heads" :config="$config"
                              compressed with-buttons hoverable with-footer/>
    </x-adminlte-card>
@endsection
