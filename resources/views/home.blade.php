@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="text-center">
                        <h4 class="mb-4">{{ __('You are logged in!') }}</h4>
                        <p class="mb-4">Bienvenido {{ Auth::user()->nombre }}</p>
                        
                        <div class="d-grid gap-2 col-6 mx-auto">
                            <a href="{{ url('/') }}" class="btn btn-primary">
                                <i class="fas fa-home me-2"></i>Regresar al Inicio
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
