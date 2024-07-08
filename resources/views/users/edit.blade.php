@extends('adminlte::page')

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Usuarios</a></li>
            <li class="breadcrumb-item"><a href="{{ route('users.show', $user->id) }}">{{ $user->email }}</a></li>
            <li class="breadcrumb-item active">Editar</li>
        </ol>
    </nav>
    @include('layouts.alert')
@endsection

@section('content')
    @include('layouts.alert')

    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <x-adminlte-card title="Editar usuario" theme="dark" icon="fas fa-lg fa-user">
                    <div class="col-md-12">
                        <x-adminlte-input name="name" label="Nombre" placeholder="nombre de usuario"
                                          type="text" label-class="text-lightblue"
                                          value="{{ $user->name }}" enable-old-support/>
                    </div>
                    <div class="col-md-12">
                        <x-adminlte-input name="email" label="Email" placeholder="ejemplo@gamil.com"
                                          type="text" label-class="text-lightblue"
                                          value="{{ $user->email }}" enable-old-support/>
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

