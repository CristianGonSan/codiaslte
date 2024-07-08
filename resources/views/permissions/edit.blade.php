@extends('adminlte::page')

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ route('permissions.index') }}">Permisos</a></li>
            <li class="breadcrumb-item"><a
                    href="{{ route('permissions.show', $permission->id) }}">{{ $permission->name }}</a></li>
            <li class="breadcrumb-item active"><a>Editar</a></li>
        </ol>
    </nav>
    @include('layouts.alert')
@stop

@section('content')
    <div class="row justify-content-center">

        <div class="col-md-6">
            <form action="{{ route('permissions.update', $permission->id ) }}" method="POST">
                @csrf
                @method('PUT')

                <x-adminlte-card title="Editar Permiso" theme="dark" icon="fas fa-lg fa-key">
                    <div class="row">
                        <div class="col-md-12">
                            <x-adminlte-input name="name" label="Nombre" placeholder="nombre"
                                              label-class="text-lightblue"
                                              value="{{ $permission->name }}" enable-old-support/>
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
