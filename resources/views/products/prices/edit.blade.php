@extends('adminlte::page')

@section('plugins.TempusDominusBs4', true)

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Productos</a></li>
            <li class="breadcrumb-item"><a href="{{ route('products.show', $product->id) }}">{{ $product->id }}</a></li>
            <li class="breadcrumb-item active"><a>Editar Precio</a></li>
        </ol>
    </nav>
@stop

@section('content')
    @include('layouts.alert')

    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="{{ route('products.prices.update', $price_history->id) }}" method="POST">
                @csrf
                @method('PUT')
                <x-adminlte-card title="Editar Precio y Fecha" theme="dark" icon="fas fa-lg fa-edit">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header py-1 px-2 bg-light">
                                    <span><i class="fas fa-box"></i> Producto</span>
                                </div>
                                <div class="p-2">
                                    {{ $product->name }} ({{$product->code}})
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <x-adminlte-input name="price" label="Precio" placeholder="Nuevo precio"
                                              type="text" label-class="text-lightblue"
                                              value="{{ $price_history->price }}" enable-old-support/>
                        </div>
                        <div class="col-md-12">

                            @php
                                $config = [
                                    'format' => 'YYYY-MM-DD HH:mm:ss',
                                    'locale' => 'es'
                                    ];
                            @endphp
                            <x-adminlte-input-date name="date" :config="$config" placeholder="Elegir una fecha..."
                                                   label="Fecha (Año/Mes/Dia Hora:Minuto)" label-class="text-lightblue"
                                                   value="{{ $price_history->date }}" enable-old-support>
                                <x-slot name="appendSlot">
                                    <x-adminlte-button theme="outline-primary" icon="fas fa-lg fa-calendar-day"
                                                       title="Establecer Fecha"/>
                                </x-slot>
                            </x-adminlte-input-date>
                        </div>
                    </div>

                    <x-slot name="footerSlot">
                        <x-adminlte-button class="btn" type="submit" label="Guardar" theme="success"
                                           icon="fas fa-lg fa-save"/>
                    </x-slot>
                </x-adminlte-card>
            </form>
        </div>
    </div>
@endsection
