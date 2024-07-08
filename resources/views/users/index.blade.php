@extends('adminlte::page')

@section('plugins.Datatables', true)
@section('plugins.DatatablesResponsive', true)
@section('plugins.DatatablesButtons', true)
@section('plugins.DatatablesSelect', true)

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
            <li class="breadcrumb-item active">Usuarios</li>
        </ol>
        <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Nuevo Usuario
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
            'Email',
            'Fecha',
            'Habilitado',
            'Verificado',
            ['label' => 'Ver', 'no-export' => true]
        ];

        $config = [
            'pagingType' => 'numbers',
            'processing' => true,
            'serverSide' => true,
            'responsive' => [
                'details' => [
                    'type' => 'column',
                    'target' => 0
                ]
            ],
            'select' => [
                'selector' => 'td:not(:first-child)'
            ],
            'ajax' => route('users.datatable'),
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
                ['data'=> 'id', 'name'=> 'id', 'responsivePriority' => 4],
                ['data'=> 'name', 'name'=> 'name', 'responsivePriority' => 1],
                ['data'=> 'email', 'name'=> 'email', 'responsivePriority' => 3],
                ['data'=> 'created_at', 'name'=> 'created_at', 'searchable' => false],
                ['data'=> 'enabled', 'name'=> 'enabled', 'orderable' => false, 'searchable' => false],
                ['data'=> 'verified', 'name'=> 'verified', 'orderable' => false, 'searchable' => false, 'responsivePriority' => 3],
                ['data'=> 'action', 'name'=> 'action', 'orderable' => false, 'searchable' => false, 'responsivePriority' => -1]
            ],
        ];
    @endphp

    <x-adminlte-card>
        <x-adminlte-datatable id="table1" :heads="$heads" :config="$config"
                              compressed with-buttons hoverable with-footer/>
    </x-adminlte-card>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            let table = $('#table1').DataTable();

            $('#table1 tbody').on('click', 'tr tr:not(.child) td:not(:first-child)', function () {
                if ($(this).hasClass('selected')) {
                    $(this).removeClass('selected');
                } else {
                    table.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                }
            });
        });
    </script>
@endsection
