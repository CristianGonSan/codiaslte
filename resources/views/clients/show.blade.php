@extends('adminlte::page')

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ route('clients.index') }}">Clientes</a></li>
            <li class="breadcrumb-item active">{{ $client->name }}</li>
        </ol>
    </nav>
    @include('layouts.alert')
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-9">
            <x-adminlte-card title="Detalles" theme="dark"
                             icon="fas fa-lg fa-building" collapsible removable maximizable>
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header py-1 px-2 bg-light">
                                <span><i class="fas fa-building"></i> Nombre de la Empresa</span>
                            </div>
                            <div class="p-2">
                                {{ $client->company_name ?? 'No hay datos' }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header py-1 px-2 bg-light">
                                <span><i class="fas fa-user"></i> Nombre</span>
                            </div>
                            <div class="p-2">
                                {{ $client->name }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header py-1 px-2 bg-light">
                                <span><i class="fas fa-phone"></i> Teléfono</span>
                            </div>
                            <div class="p-2">
                                {{ $client->phone }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header py-1 px-2 bg-light">
                                <span><i class="fas fa-envelope"></i> Correo Electrónico</span>
                            </div>
                            <div class="p-2">
                                {{ $client->email ?? 'No hay datos' }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header py-1 px-2 bg-light">
                                <span><i class="fas fa-map-marker-alt"></i> Dirección</span>
                            </div>
                            <div class="p-2">
                                {{ $client->address ?? 'No hay datos' }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header py-1 px-2 bg-light">
                                <span><i class="fas fa-city"></i> Ciudad</span>
                            </div>
                            <div class="p-2">
                                {{ $client->city ?? 'No hay datos' }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header py-1 px-2 bg-light">
                                <span><i class="fas fa-map"></i> Estado</span>
                            </div>
                            <div class="p-2">
                                {{ $client->state ?? 'No hay datos' }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header py-1 px-2 bg-light">
                                <span><i class="fas fa-flag"></i> País</span>
                            </div>
                            <div class="p-2">
                                {{ $client->country ?? 'No hay datos' }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header py-1 px-2 bg-light">
                                <span><i class="fas fa-mail-bulk"></i> Código Postal</span>
                            </div>
                            <div class="p-2">
                                {{ $client->postal_code ?? 'No hay datos' }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header py-1 px-2 bg-light">
                                <span><i class="fas fa-id-card"></i> RFC</span>
                            </div>
                            <div class="p-2">
                                {{ $client->rfc_id ?? 'No hay datos' }}
                            </div>
                        </div>
                    </div>
                </div>

                <x-slot name="footerSlot">
                    <div class="row justify-content-left">
                        <div class="col-auto">
                            <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-outline-info">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                        </div>

                        <div class="col-auto">
                            <form action="{{ route('clients.destroy', $client->id) }}" method="POST"
                                  onsubmit="return confirm('¿Estás seguro de querer eliminar este cliente?')">
                                @csrf
                                @method('DELETE')
                                <x-adminlte-button class="btn" type="submit" label="Eliminar" theme="outline-danger"
                                                   icon="fas fa-lg fa-trash-alt"/>
                            </form>
                        </div>
                    </div>
                </x-slot>
            </x-adminlte-card>
        </div>
    </div>
@endsection
