@extends('adminlte::page')

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Usuarios</a></li>
            <li class="breadcrumb-item active">{{ $user->email }}</li>
        </ol>
    </nav>
    @include('layouts.alert')
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-9">
            <x-adminlte-card title="Detalles" theme="dark"
                             icon="fas fa-lg fa-user" collapsible removable maximizable>
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

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header py-1 px-2 bg-light">
                                <span><i class="fas fa-address-card"></i> Email</span>
                            </div>
                            <div class="p-2">
                                {{ $user->email }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header py-1 px-2 bg-light">
                                <span><i class="fas fa-user"></i> Verificación</span>
                            </div>
                            <div class="p-2">
                                @if( $user->hasVerifiedEmail())
                                    Usuario Verificado.
                                @else
                                    Usuario no Verificado.
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header py-1 px-2 bg-light">
                                <span><i class="fas fa-calendar-day"></i> Creado el</span>
                            </div>
                            <div class="p-2">
                                {{ $user->created_at }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header py-1 px-2 bg-light">
                                <span><i class="fas fa-edit"></i> Actualizado el</span>
                            </div>
                            <div class="p-2">
                                {{ $user->updated_at }}
                            </div>
                        </div>
                    </div>
                </div>

                <x-slot name="footerSlot">
                    <div class="btn-group d-flex flex-wrap justify-content-start" role="group"
                         aria-label="Acciones de usuario">
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-outline-info">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        <a href="{{ route('users.password', $user->id) }}" class="btn btn-outline-warning">
                            <i class="fas fa-lock"></i> Cambiar contraseña
                        </a>

                        @if(!$user->hasVerifiedEmail())
                            <a id="verify-button" href="{{ route('verification.send', $user->id) }}"
                               class="btn btn-outline-success" onclick="processButton()">
                                <i class="fas fa-envelope"></i> Enviar Verificación
                            </a>
                        @endif

                        @if($user->enabled)
                            <form action="{{ route('users.disable', $user->id) }}" method="POST"
                                  onsubmit="return confirm('¿Estás seguro de querer deshabilitar a este usuario?')"
                                  class="d-inline">
                                @csrf
                                @method('PATCH')
                                <x-adminlte-button class="btn" type="submit" label="Deshabilitar"
                                                   theme="outline-secondary" icon="fas fa-lg fa-user-lock"/>
                            </form>
                        @else
                            <form action="{{ route('users.enable', $user->id) }}" method="POST"
                                  onsubmit="return confirm('¿Estás seguro de querer habilitar a este usuario?')"
                                  class="d-inline">
                                @csrf
                                @method('PATCH')
                                <x-adminlte-button class="btn" type="submit" label="Habilitar" theme="outline-secondary"
                                                   icon="fas fa-lg fa-user-check"/>
                            </form>
                        @endif

                        <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                              onsubmit="return confirm('¿Estás seguro de querer eliminar este usuario?')"
                              class="d-inline">
                            @csrf
                            @method('DELETE')
                            <x-adminlte-button class="btn" type="submit" label="Eliminar" theme="outline-danger"
                                               icon="fas fa-lg fa-trash-alt"/>
                        </form>
                    </div>
                </x-slot>
            </x-adminlte-card>

            <x-adminlte-card title="Roles" theme="dark" icon="fas fa-lg fa-user-tie" collapsible removable maximizable>
                <div class="col-md-12">
                    <div class="row overflow-auto" style="max-height: 30vh;">
                        @if($user->roles->isEmpty())
                            Este usuario no tiene roles.
                        @else
                            @foreach($user->getRoleNames() as $role)
                                <div class="m-1 px-2 bg-info">
                                    {{ $role }}
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

                <x-slot name="footerSlot">
                    <div class="row justify-content-between">
                        <div class="col-auto">
                            <a href="{{ route('users.roles', $user->id) }}" class="btn btn-outline-info">
                                <i class="fas fa-edit"></i> Editar Roles
                            </a>
                        </div>
                    </div>
                </x-slot>
            </x-adminlte-card>
        </div>
    </div>
@endsection

@section('js')
    <script>
        function processButton() {
            const verifyButton = document.getElementById('verify-button');
            verifyButton.innerHTML = '<i class="fas fa-sync-alt fa-spin"></i></i> Procesando...</div>';

            verifyButton.classList.add('disabled');
        }
    </script>
@endsection
