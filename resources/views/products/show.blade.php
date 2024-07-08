@extends('adminlte::page')

@section('plugins.Datatables', true)
@section('plugins.DatatablesResponsive', true)
@section('plugins.Chartjs', true)

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Productos</a></li>
            <li class="breadcrumb-item active">{{ $product->id }}</li>
        </ol>
    </nav>
@stop

@section('content')
    @include('layouts.alert')

    <div class="row justify-content-center">
        <div class="col-md-9">
            <x-adminlte-card title="Detalles" theme="dark"
                             icon="fas fa-lg fa-box" collapsible removable maximizable>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header py-1 px-2 bg-light">
                                <span><i class="fas fa-box"></i> Nombre</span>
                            </div>
                            <div class="p-2">
                                {{ $product->name }} ({{ $product->code }})
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header py-1 px-2 bg-light">
                                <span><i class="fas fa-weight-hanging"></i> Unidad de medida</span>
                            </div>
                            <div class="p-2">
                                {{ $product->unit }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header py-1 px-2 bg-light">
                                <span><i class="fas fa-dollar-sign"></i> Precio por Unidad</span>
                            </div>
                            <div class="p-2">
                                {{ $product->price }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header py-1 px-2 bg-light">
                                <span><i class="fas fa-file-alt"></i> Ficha Técnica</span>
                            </div>
                            <div class="p-2">
                                @if($product->data_sheet == null)
                                    No hay ficha.
                                @else
                                    <a href="{{ $product->data_sheet }}">{{ $product->data_sheet }}</a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header py-1 px-2 bg-light">
                                <span><i class="fas fa-calendar-day"></i> Creado el</span>
                            </div>
                            <div class="p-2">
                                {{ $product->created_at }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header py-1 px-2 bg-light">
                                <span><i class="fas fa-edit"></i> Actualizado el</span>
                            </div>
                            <div class="p-2">
                                {{ $product->updated_at }}
                            </div>
                        </div>
                    </div>
                </div>

                <x-adminlte-card title="Descripción" collapsible>
                    {{ $product->description ?? 'No hay descripción' }}
                </x-adminlte-card>

                <x-slot name="footerSlot">
                    <div class="row justify-content-left">
                        <div class="col-auto">
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-outline-info">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                        </div>
                        <div class="col-auto">
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                  onsubmit="return confirm('¿Estás seguro de querer eliminar este producto?')">
                                @csrf
                                @method('DELETE')
                                <x-adminlte-button type="submit" label="Eliminar" theme="outline-danger"
                                                   icon="fas fa-lg fa-trash-alt"/>
                            </form>
                        </div>
                    </div>
                </x-slot>
            </x-adminlte-card>
        </div>
        <div class="col-md-9">
            <x-adminlte-card title="Historial de Precios" theme="dark"
                             icon="fas fa-lg fa-dollar-sign" collapsible removable maximizable>
                <canvas id="chart1"></canvas>
            </x-adminlte-card>

            @php
                $heads = [
                    'Precio',
                    'Fecha',
                    'Actualizado',
                    ['label' => 'Acción', 'no-export' => true]];

                $config = [
                    'searching' => false,
                    'pagingType' => 'numbers',
                    'responsive' => true,
                    'order' => [
                        [1, 'desc'] // Ordena por la primera columna de manera descendente (ID en este caso)
                        ],
                    'columns' => [
                        ['data' => 'price', 'name' => 'price', 'searchable' => false, 'responsivePriority' => 1],
                        ['data' => 'created_at', 'name' => 'created_at', 'searchable' => false, 'responsivePriority' => 2],
                        ['data' => 'update_at', 'name' => 'update_at', 'searchable' => false, 'responsivePriority' => 5],
                        ['data' => 'action', 'name' => 'action', 'orderable' => false, 'searchable' => false, 'responsivePriority' => -1],
            ],
                    ];
            @endphp

            <x-adminlte-card title="Detalles de Precios" theme="dark" icon="fas fa-lg fa-dollar-sign"
                             collapsible removable maximizable>
                <x-adminlte-datatable id="table1" :heads="$heads" :config="$config"
                                      compressed hoverable with-footer beautify>
                    @foreach( $price_history as $record)
                        <tr>
                            <th>{{ $record->price }}</th>
                            <th>{{ $record->date }}</th>
                            <th>{{ $record->updated_at }}</th>
                            <th class="row justify-content-center">
                                <a href="{{ route('products.prices.edit', $record->id) }}"
                                   class="btn btn-outline-warning btn-sm mr-1">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('products.prices.destroy', $record->id) }}" method="POST"
                                      onsubmit="return confirm('¿Estás seguro de querer eliminar este registro?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </th>
                        </tr>
                    @endforeach
                </x-adminlte-datatable>

                <x-slot name="footerSlot">
                    <form action="{{ route('products.prices.new', $product->id)}}" method="POST">
                        @csrf
                        @method('PATCH')
                        <x-adminlte-input name="price" placeholder="Nuevo precio"
                                          label-class="text-lightblue" type="text"
                                          enable-old-support>
                            <x-slot name="prependSlot">
                                <div class="input-group-text text-olive">
                                    <i class="fas fa-dollar-sign"></i>
                                </div>
                            </x-slot>
                            <x-slot name="appendSlot">
                                <x-adminlte-button type="submit" label="Actualizar" theme="outline-success"/>
                            </x-slot>
                        </x-adminlte-input>
                    </form>
                </x-slot>
            </x-adminlte-card>
        </div>
    </div>

@endsection

@section('js')
    <script>
        $(document).ready(function () {
            let labels = [];
            let prices = [];

            @json( $price_history ).
            forEach(function (item) {
                // Formatear la fecha como DD/MM/YYYY
                let formattedDate = new Date(item.date).toLocaleDateString('es-ES');
                labels.push(formattedDate);
                prices.push(item.price);
            });
            let ctx = $('#chart1')[0].getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Precio',
                        data: prices,
                        backgroundColor: [
                            'rgba(53, 247, 37, 0.2)',
                        ],
                        borderColor: [
                            'rgba(53, 247, 37, 1)',
                        ],
                        borderWidth: 1,
                        tension: 0.1,
                    }]
                },
                options: {
                    scales: {
                        x: {
                            type: 'time',
                            time: {
                                unit: 'day',
                                tooltipFormat: 'DD/MM/YYYY'
                            }
                        },
                        y: {
                            beginAtZero: true
                        }
                    },

                },
            });
        });
    </script>
@endsection
