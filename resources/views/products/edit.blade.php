@extends('adminlte::page')

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Productos</a></li>
            <li class="breadcrumb-item"><a href="{{ route('products.show', $product->id) }}">{{ $product->id }}</a></li>
            <li class="breadcrumb-item active"><a>Editar</a></li>
        </ol>
    </nav>
@stop

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="{{ route('products.update', $product->id) }}" method="POST">
                @csrf
                @method('PUT')

                <x-adminlte-card title="Editar Producto" theme="dark" icon="fas fa-lg fa-shopping-cart">
                    <div class="row">
                        <div class="col-md-9">
                            <x-adminlte-input name="name" label="Nombre" placeholder="nombre"
                                              label-class="text-lightblue"
                                              value="{{ $product->name }}"
                                              enable-old-support/>
                        </div>
                        <div class="col-md-3">
                            <x-adminlte-input name="code" label="Código" placeholder="código técnico"
                                              label-class="text-lightblue" value="{{ $product->code }}"
                                              enable-old-support/>
                        </div>
                        <div class="col-md-3">
                            <x-adminlte-input name="unit" label="Unidad" placeholder="unidad"
                                              label-class="text-lightblue" value="{{ $product->unit }}"
                                              enable-old-support/>
                        </div>
                        <div class="col-md-9">
                            <x-adminlte-input name="price" label="Precio" placeholder="precio"
                                              label-class="text-lightblue" value="{{ $product->price }}"
                                              enable-old-support readonly/>
                        </div>
                        <div class="col-md-12">
                            <x-adminlte-textarea name="description" label="Description" rows=5
                                                 label-class="text-warning"
                                                 igroup-size="sm" placeholder="Insert description..."
                                                 enable-old-support>
                                {{ $product->description }}
                                <x-slot name="prependSlot">
                                    <div class="input-group-text bg-dark">
                                        <i class="fas fa-lg fa-file-alt text-warning"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-textarea>
                        </div>

                        <div class="col-md-12">
                            <x-adminlte-input name="data_sheet" label="Hoja Técnica" placeholder="hoja técnica"
                                              label-class="text-lightblue"
                                              value="{{ $product->data_sheet }}" enable-old-support/>
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
