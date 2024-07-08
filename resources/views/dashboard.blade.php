@extends('adminlte::page')

@section('content')
    <div class="container p-3">
        <div class="row">
            <!-- Box 1: New Orders -->
            <div class="col-lg-3 col-md-3 col-sm-12">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $count_products }}</h3>
                        <p>Productos</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <a href="{{ route('products.index') }}" class="small-box-footer">
                        Ver más <i class="fas fa-arrow-circle-right"></i>
                    </a>
                    @if( !Auth::user()->can('products view') ) @include('layouts.lock') @endif
                </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-12">
                <div class="small-box bg-gradient-success">
                    <div class="inner">
                        <h3>{{ $count_clients }}</h3>
                        <p>Clientes</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <a href="{{ route('clients.index') }}" class="small-box-footer">
                        Ver más <i class="fas fa-arrow-circle-right"></i>
                    </a>
                    @if( !Auth::user()->can('clients view') ) @include('layouts.lock') @endif
                </div>
            </div>

            <!-- Box 2: User Registrations -->
            <div class="col-lg-3 col-md-3 col-sm-12">
                <div class="small-box bg-gradient-success">
                    <div class="inner">
                        <h3>{{ $count_users }}</h3>
                        <p>Usuarios</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <a href="{{ route('users.index') }}" class="small-box-footer">
                        Ver más <i class="fas fa-arrow-circle-right"></i>
                    </a>
                    @if( !Auth::user()->can('users view') ) @include('layouts.lock') @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('[data-widget="navbar-search"]').hide();
        });
    </script>
@endsection
