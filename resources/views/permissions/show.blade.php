@extends('adminlte::page')

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ route('permissions.index') }}">Permisos</a></li>
            <li class="breadcrumb-item active">{{ $permission->name }}</li>
        </ol>
    </nav>
    @include('layouts.alert')
@stop

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-9">
            <x-adminlte-card title="Detalles" theme="dark"
                             icon="fas fa-lg fa-key" collapsible removable maximizable>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header py-1 px-2 bg-light">
                                <span><i class="fas fa-user"></i> Nombre</span>
                            </div>
                            <div class="p-2">
                                {{ $permission->name }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header py-1 px-2 bg-light">
                                <span><i class="fas fa-calendar-day"></i> Creado el</span>
                            </div>
                            <div class="p-2">
                                {{ $permission->created_at }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header py-1 px-2 bg-light">
                                <span><i class="fas fa-edit"></i> Actualizado el</span>
                            </div>
                            <div class="p-2">
                                {{ $permission->updated_at }}
                            </div>
                        </div>
                    </div>
                </div>

                <x-slot name="footerSlot">
                    <div class="row justify-content-left">
                        <div class="col-auto">
                            <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-outline-info">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                        </div>

                        <div class="col-auto">
                            <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST"
                                  onsubmit="return confirm('¿Estás seguro de querer eliminar este permiso?')">
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

            <x-adminlte-card title="Roles asignados" theme="dark" icon="fas fa-lg fa-user-tie" collapsible removable
                             maximizable>
                <div class="col-md-12">
                    <div class="row overflow-auto" style="max-height: 30vh;">
                        @if( $permission->roles->isEmpty())
                            Este permiso no pertenece a ningún rol.
                        @else
                            {{ $permission->getRoleNames() }}
                        @endif
                    </div>
                </div>
            </x-adminlte-card>
        </div>
    </div>
@endsection
