@extends('adminlte::page')

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ route('clients.index') }}">Clientes</a></li>
            <li class="breadcrumb-item"><a href="{{ route('clients.show', $client->id) }}">{{ $client->name }}</a></li>
            <li class="breadcrumb-item active">Editar</li>
        </ol>
    </nav>
    @include('layouts.alert')
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="{{ route('clients.update', $client->id) }}" method="POST">
                @csrf
                @method('PUT')

                <x-adminlte-card title="Editar Cliente" theme="dark" icon="fas fa-lg fa-user">
                    <div class="row">
                        <div class="col-md-12">
                            <x-adminlte-input name="company_name" label="Nombre de la Empresa" placeholder="Nombre de la Empresa"
                                              label-class="text-lightblue"
                                              enable-old-support value="{{ $client->company_name }}"/>
                        </div>
                        <div class="col-md-6">
                            <x-adminlte-input name="name" label="Nombre" placeholder="Nombre"
                                              label-class="text-lightblue"
                                              enable-old-support value="{{ $client->name }}"/>
                        </div>
                        <div class="col-md-6">
                            <x-adminlte-input name="phone" label="Teléfono" placeholder="Teléfono"
                                              label-class="text-lightblue"
                                              enable-old-support value="{{ $client->phone }}"/>
                        </div>
                        <div class="col-md-12">
                            <x-adminlte-input name="email" label="Correo Electrónico" placeholder="Correo Electrónico"
                                              label-class="text-lightblue"
                                              enable-old-support value="{{ $client->email }}"/>
                        </div>
                        <div class="col-md-12">
                            <x-adminlte-input name="address" label="Dirección" placeholder="Dirección"
                                              label-class="text-lightblue"
                                              enable-old-support value="{{ $client->address }}"/>
                        </div>
                        <div class="col-md-6">
                            <x-adminlte-input name="city" label="Ciudad" placeholder="Ciudad"
                                              label-class="text-lightblue"
                                              enable-old-support value="{{ $client->city }}"/>
                        </div>
                        <div class="col-md-6">
                            <x-adminlte-input name="state" label="Estado" placeholder="Estado"
                                              label-class="text-lightblue"
                                              enable-old-support value="{{ $client->state }}"/>
                        </div>
                        <div class="col-md-6">
                            <x-adminlte-input name="country" label="País" placeholder="País"
                                              label-class="text-lightblue"
                                              enable-old-support value="{{ $client->country }}"/>
                        </div>
                        <div class="col-md-6">
                            <x-adminlte-input name="postal_code" label="Código Postal" placeholder="Código Postal"
                                              label-class="text-lightblue"
                                              enable-old-support value="{{ $client->postal_code }}"/>
                        </div>
                        <div class="col-md-12">
                            <x-adminlte-input name="rfc_id" label="RFC" placeholder="RFC"
                                              label-class="text-lightblue"
                                              enable-old-support value="{{ $client->rfc_id }}"/>
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
