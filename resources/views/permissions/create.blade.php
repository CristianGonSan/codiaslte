@extends('adminlte::page')

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ route('permissions.index') }}">Permisos</a></li>
            <li class="breadcrumb-item active">Nuevo</li>
        </ol>
    </nav>
    @include('layouts.alert')
@endsection

@section('content')
    <div class="row justify-content-center">

        <div class="col-md-6">
            <form action="{{ route('permissions.store') }}" method="POST">
                @csrf

                <x-adminlte-card title="Crear Permiso" theme="dark" icon="fas fa-lg fa-key">
                    <div class="row">
                        <div class="col-md-12">
                            <x-adminlte-input name="name" label="Nombre" placeholder="nombre"
                                              label-class="text-lightblue"
                                              enable-old-support/>
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
