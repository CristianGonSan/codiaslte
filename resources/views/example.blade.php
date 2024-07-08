@extends('adminlte::page')

@section('plugins.Datatables', true)
@section('plugins.Chartjs', true)

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Productos</a></li>
            <li class="breadcrumb-item active"><a>{{ $product->id }}</a></li>
        </ol>
    </nav>
@stop

@section('content')
    <div class="row justify-content-left pt-3">
        <div class="col-md-6">
            <x-adminlte-card theme="dark" title="Detalles" icon="fas fa-lg fa-shopping-cart"
                             collapsible removable maximizable>
                <dl class="row">
                    <dt class="col-sm-4 text-lightblue">Nombre:</dt>
                    <dd class="col-sm-8">{{ $product->name }}</dd>

                    <dt class="col-sm-4 text-lightblue">Código:</dt>
                    <dd class="col-sm-8">{{ $product->code }}</dd>

                    <dt class="col-sm-4 text-lightblue">Unidad:</dt>
                    <dd class="col-sm-8">{{ $product->unit }}</dd>

                    <dt class="col-sm-4 text-lightblue">Precio:</dt>
                    <dd class="col-sm-8">${{ number_format($product->price) }}</dd>

                    <dt class="col-sm-4 text-warning">Descripción:</dt>
                    <dd class="col-sm-8">{{ $product->description }}</dd>

                    <dt class="col-sm-4 text-lightblue">Hoja Técnica:</dt>
                    <dd class="col-sm-8">{{ $product->data_sheet }}</dd>

                    <dt class="col-sm-4 text-lightblue">Creado:</dt>
                    <dd class="col-sm-8">{{ $product->created_at->format('d/m/Y H:i:s') }}</dd>

                    <dt class="col-sm-4 text-lightblue">Actualizado:</dt>
                    <dd class="col-sm-8">{{ $product->updated_at->format('d/m/Y H:i:s') }}</dd>
                </dl>

                <x-slot name="footerSlot">
                    <div class="row justify-content-left">
                        <div class="col-auto">
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                        </div>
                        <div class="col-auto">
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-trash"></i> Eliminar
                                </button>
                            </form>
                        </div>
                    </div>
                </x-slot>
            </x-adminlte-card>
        </div>

        <div class="col-md-6">
            <x-adminlte-card title="Historial de Precios" theme="dark"
                             icon="fas fa-lg fa-dollar-sign" collapsible removable maximizable>
                <canvas id="chart1"></canvas>
            </x-adminlte-card>

            @php
                $heads = [
                    'Precio',
                    'Fecha',
                    ['label' => 'Acción', 'no-export' => true]];

                $config = [
                    'searching' => false,
                    'pagingType' => 'numbers',
                    'responsive' => true,
                    'order' => [
                        [1, 'desc'] // Ordena por la primera columna de manera descendente (ID en este caso)
                        ],
                    ];
            @endphp

            <x-adminlte-card title="Detalles de Precios" theme="dark" icon="fas fa-lg fa-dollar-sign"
                             collapsible removable maximizable style="font-size: 14px">
                <x-adminlte-datatable id="table1" :heads="$heads" :config="$config"
                                      compressed hoverable with-footer>
                    @foreach( $price_history as $record)
                        <tr>
                            <th>{{ $record->price }}</th>
                            <th>{{ $record->date }}</th>
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
