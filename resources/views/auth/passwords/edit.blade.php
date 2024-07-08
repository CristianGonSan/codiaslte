@extends('adminlte::page')

@section('content')
    <div class="row justify-content-center pt-3">
        <div class="col-md-6">
            <form action="{{ route('password.update') }}" method="POST">
                @csrf
                @method('PATCH')

                <x-adminlte-card title="Cambiar mi contraseña" icon="fas fa-lg fa-lock">
                    <div class="col-md-12">
                        <x-adminlte-input name="current_password" label="Contraseña Actual" placeholder="contraseña actual"
                                          type="password" label-class="text-lightblue"
                                          enable-old-support/>
                    </div>
                    <div class="col-md-12">
                        <x-adminlte-input name="password" label="Nueva Contraseña" placeholder="nueva contraseña"
                                          type="password" label-class="text-lightblue"
                                          enable-old-support/>
                    </div>
                    <div class="col-md-12">
                        <x-adminlte-input name="password_confirmation" label="Confirmar" placeholder="repetir nueva contraseña"
                                          type="password" label-class="text-lightblue"
                                          enable-old-support/>
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
