@extends('adminlte::page')

@section('content')

    @include('layouts.alert')

    <div class="row justify-content-center pt-3">
        <div class="col-md-9">
            <x-adminlte-card title="Mis datos" theme="dark"
                             icon="fas fa-lg fa-user" collapsible removable maximizable>
                <dl class="row">

                    <dt class="col-sm-4 text-lightblue">Nombre:</dt>
                    <dd class="col-sm-8">{{ Auth::user()->name }}</dd>

                    <dt class="col-sm-4 text-lightblue">Email:</dt>
                    <dd class="col-sm-8">{{ Auth::user()->email }}</dd>

                    <dt class="col-sm-4 text-warning">Verificación:</dt>
                    <dd class="col-sm-8">
                        @if( Auth::user()->hasVerifiedEmail())
                            Usuario Verificado.
                        @else
                            Usuario no Verificado.
                        @endif
                    </dd>

                    <dt class="col-sm-4 text-lightblue">Creado el:</dt>
                    <dd class="col-sm-8">{{ Auth::user()->created_at->format('d/m/Y H:i:s') }}</dd>

                    <dt class="col-sm-4 text-lightblue">Actualizado el:</dt>
                    <dd class="col-sm-8">{{ Auth::user()->updated_at->format('d/m/Y H:i:s') }}</dd>

                </dl>

                <x-slot name="footerSlot">
                    <div class="row justify-content-left">
                        <div class="col-auto">
                            <a href="{{ route('users.edit', Auth::user()->id) }}" class="btn btn-outline-info">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                        </div>

                        <div class="col-auto">
                            <form action="{{ route('users.disable', Auth::user()->id) }}" method="POST"
                                  onsubmit="return confirm('¿Estás seguro de querer deshabilitar tu usuario?')">
                                @csrf
                                @method('PATCH')
                                <x-adminlte-button class="btn" type="submit" label="Deshabilitar" theme="outline-danger"
                                                   icon="fas fa-lg fa-user-lock"/>
                            </form>
                        </div>
                    </div>
                </x-slot>
            </x-adminlte-card>
        </div>

        <div class="col-md-3">
            <x-adminlte-card title="Roles" theme="dark" icon="fas fa-lg fa-user-tie" collapsible removable maximizable>
                <div class="col-md-12">
                    <div class="row overflow-auto" style="max-height: 30vh;">
                        @if(Auth::user()->roles->isEmpty())
                            Este usuario no tiene roles.
                        @else
                            @foreach(Auth::user()->getRoleNames() as $role)
                                <div class="m-1 px-2 bg-info">
                                    {{ $role }}
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </x-adminlte-card>
        </div>
    </div>
@endsection
