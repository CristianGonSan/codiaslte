@extends('adminlte::page')

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Usuarios</a></li>
            <li class="breadcrumb-item"><a href="{{ route('users.show', $user->id) }}">{{ $user->email }}</a></li>
            <li class="breadcrumb-item active">Cambiar Contraseña</li>
        </ol>
    </nav>
    @include('layouts.alert')
@endsection

@section('content')
    @include('layouts.alert')

    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="{{ route('users.password', $user->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <x-adminlte-card title="Cambiar contraseña" theme="dark" icon="fas fa-lg fa-lock">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header py-1 px-2 bg-light">
                                    <span><i class="fas fa-user"></i> Nombre</span>
                                </div>
                                <div class="p-2">
                                    {{ $user->name }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header py-1 px-2 bg-light">
                                    <span><i class="fas fa-address-card"></i> Email</span>
                                </div>
                                <div class="p-2">
                                    {{ $user->email }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <x-adminlte-input name="password" label="Nueva Contraseña" placeholder="nueva contraseña"
                                              type="password" label-class="text-lightblue"
                                              enable-old-support/>
                        </div>
                        <div class="col-md-12">
                            <x-adminlte-input name="password_confirmation" label="Confirmar"
                                              placeholder="repetir nueva contraseña"
                                              type="password" label-class="text-lightblue"
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
