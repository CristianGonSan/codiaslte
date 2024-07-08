@extends('adminlte::page')

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Usuarios</a></li>
            <li class="breadcrumb-item active">Nuevo</li>
        </ol>
    </nav>
    @include('layouts.alert')
@endsection

@section('content')
    <link rel="stylesheet" href="{{ asset('css/checkboxs/checkbox.css') }}">

    @include('layouts.alert')

    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="{{ route('users.store') }}" method="POST">
                @csrf

                <x-adminlte-card title="Crear usuario" theme="dark" icon="fas fa-lg fa-user">
                    <div class="col-md-12">
                        <x-adminlte-input name="name" label="Nombre" placeholder="nombre de usuario"
                                          type="text" label-class="text-lightblue"
                                          enable-old-support/>
                    </div>
                    <div class="col-md-12">
                        <x-adminlte-input name="email" label="Email" placeholder="ejemplo@gamil.com"
                                          type="text" label-class="text-lightblue"
                                          enable-old-support/>
                    </div>
                    <div class="col-md-12">
                        <x-adminlte-input name="password" label="Contraseña" placeholder="contraseña"
                                          type="password" label-class="text-lightblue"
                                          enable-old-support/>
                    </div>
                    <div class="col-md-12">
                        <x-adminlte-input name="password_confirmation" label="Confirmar"
                                          placeholder="repetir contraseña"
                                          type="password" label-class="text-lightblue"/>
                    </div>

                    <div class="col-md-12">
                        <x-adminlte-card title="Roles disponibles" icon="fas fa-lg fa-user-tie">
                            <div class="row overflow-auto" style="max-height: 30vh;">
                                @if($roles->isEmpty())
                                    No hay roles.
                                @else
                                    @foreach($roles as $role)
                                        <div class="col-md-6 p-1">
                                            <label class="checkbox-container">{{ $role->name }}
                                                <input type="checkbox"
                                                       name="roles[]"
                                                       value="{{ $role->name }}"
                                                       id="role-{{ $role->id }}">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </x-adminlte-card>
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
