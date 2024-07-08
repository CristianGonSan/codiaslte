@extends('adminlte::page')

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
            <li class="breadcrumb-item active">{{ $role->name }}</li>
        </ol>
    </nav>
    @include('layouts.alert')
@stop

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-9">
            <x-adminlte-card title="Detalles" theme="dark"
                             icon="fas fa-lg fa-user-tie" collapsible removable maximizable>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header py-1 px-2 bg-light">
                                <span><i class="fas fa-user"></i> Nombre</span>
                            </div>
                            <div class="p-2">
                                {{ $role->name }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header py-1 px-2 bg-light">
                                <span><i class="fas fa-calendar-day"></i> Creado el</span>
                            </div>
                            <div class="p-2">
                                {{ $role->created_at }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header py-1 px-2 bg-light">
                                <span><i class="fas fa-edit"></i> Actualizado el</span>
                            </div>
                            <div class="p-2">
                                {{ $role->updated_at }}
                            </div>
                        </div>
                    </div>
                </div>

                <x-slot name="footerSlot">
                    <div class="row justify-content-left">
                        <div class="col-auto">
                            <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-outline-info">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                        </div>

                        <div class="col-auto">
                            <form action="{{ route('roles.destroy', $role->id) }}" method="POST"
                                  onsubmit="return confirm('¿Estás seguro de querer eliminar este rol?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger">
                                    <i class="fas fa-trash-alt"></i> Eliminar
                                </button>
                            </form>
                        </div>
                    </div>
                </x-slot>
            </x-adminlte-card>

            <x-adminlte-card title="Permisos" theme="dark" icon="fas fa-lg fa-key" collapsible removable
                             maximizable>
                <div class="col-md-12">
                    <div class="row overflow-auto justify-content-left" style="max-height: 30vh;">
                        @if($role->permissions->isEmpty())
                            Este rol no tiene permisos.
                        @else
                            @foreach($role->getPermissionNames() as $permission)
                                <div class="m-1 px-2 bg-info">
                                    {{ $permission }}
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <x-slot name="footerSlot">
                    <div class="row justify-content-between">
                        <div class="col-auto">
                            <a href="{{ route('roles.permissions', $role->id) }}" class="btn btn-outline-info">
                                <i class="fas fa-edit"></i> Editar Permisos
                            </a>
                        </div>
                    </div>
                </x-slot>
            </x-adminlte-card>
        </div>
    </div>
@endsection
