@extends('template.master')
@section('contenido')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-center">Mensaje</h2>
                </div>

                <div class="card-body">
                    @if($var === '1')
                        <div class="alert alert-success">
                            {!! $msj !!}
                        </div>
                    @else
                        <div class="alert alert-danger">
                            {!! $msj !!}
                        </div>
                    @endif

                    <div class="text-center mt-4">
                        <a href="{{ url($ruta_boton) }}" class="btn btn-primary btn-lg">
                            {!! $mensaje_boton !!}
                        </a>
                        <a href="{{ url('/') }}" class="btn btn-secondary btn-lg ml-2">
                            Regresar al Inicio
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection 