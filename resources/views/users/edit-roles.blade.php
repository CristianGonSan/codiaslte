@extends('adminlte::page')

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Usuarios</a></li>
            <li class="breadcrumb-item"><a href="{{ route('users.show', $user->id) }}">{{ $user->id }}</a></li>
            <li class="breadcrumb-item active">Editar Roles</li>
        </ol>
    </nav>
    @include('layouts.alert')
@endsection

@section('content')
    <link rel="stylesheet" href="{{ asset('css/checkboxs/checkbox.css') }}">

    @include('layouts.alert')

    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="{{ route('users.roles', $user->id) }}" method="POST">
                @csrf
                @method('PATCH')

                <x-adminlte-card title="Editar Roles" theme="dark" icon="fas fa-lg fa-user">
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
                                                           id="role-{{ $role->id }}"
                                                           @if($user->hasRole($role->name)) checked @endif>
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
