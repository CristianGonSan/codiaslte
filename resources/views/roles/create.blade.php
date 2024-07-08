@extends('adminlte::page')

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
            <li class="breadcrumb-item active">Nuevo</li>
        </ol>
    </nav>
    @include('layouts.alert')
@endsection

@section('content')
    <link rel="stylesheet" href="{{ asset('css/checkboxs/checkbox.css') }}">

    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="{{ route('roles.store') }}" method="POST">
                @csrf

                <x-adminlte-card title="Crear Rol" theme="dark" icon="fas fa-lg fa-user-tie">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-12">
                                <x-adminlte-input name="name" label="Nombre" placeholder="nombre"
                                                  label-class="text-lightblue"
                                                  enable-old-support/>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <x-adminlte-card title="Permisos disponibles">
                                <div class="row overflow-auto" style="max-height: 30vh;">
                                    @if($permissions->isEmpty())
                                        No hay permisos.
                                    @else
                                        @foreach($permissions as $permission)
                                            <div class="col-md-6 p-1">
                                                <label class="checkbox-container">{{ $permission->name }}
                                                    <input type="checkbox"
                                                           name="permissions[]"
                                                           value="{{ $permission->name }}"
                                                           id="role-{{ $permission->id }}">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </x-adminlte-card>
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

