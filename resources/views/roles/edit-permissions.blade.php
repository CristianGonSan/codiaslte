@extends('adminlte::page')

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
            <li class="breadcrumb-item"><a href="{{ route('roles.show', $role->id) }}">{{ $role->name }}</a></li>
            <li class="breadcrumb-item active">Editar Permisos</li>
        </ol>
    </nav>
    @include('layouts.alert')
@endsection

@section('content')
    <link rel="stylesheet" href="{{ asset('css/checkboxs/checkbox.css') }}">

    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="{{ route('roles.permissions', $role->id) }}" method="POST">
                @csrf
                @method('PATCH')

                <x-adminlte-card title="Editar Permisos" theme="dark" icon="fas fa-lg fa-user-tie">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header py-1 px-2 bg-light">
                                    <span><i class="fas fa-user-tie"></i> Nombre</span>
                                </div>
                                <div class="p-2">
                                    {{ $role->name }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <x-adminlte-card title="Roles disponibles" icon="fas fa-lg fa-key">
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
                                                           id="role-{{ $permission->id }}"
                                                           @if($role->hasPermissionTo($permission->name)) checked @endif>
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

