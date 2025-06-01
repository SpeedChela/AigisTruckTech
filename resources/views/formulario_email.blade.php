@extends('template.master')
@section('contenido')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          <h2 class="text-center">Enviar Correo electrónico</h2>
        </div>

        <div class="card-body">
          <form method="POST" action="{{ url('enviar_correo') }}">
            @csrf

            <div class="form-group">
              <label for="destinatario">Para:</label>
              <input type="email" class="form-control" name="destinatario" id="destinatario" 
                     placeholder="Ingresa la dirección de destino" required>
            </div>

            <div class="form-group">
              <label for="asunto">Asunto:</label>
              <input type="text" class="form-control" name="asunto" id="asunto" 
                     placeholder="Ingresa el asunto" required>
            </div>

            <div class="form-group">
              <label for="contenido_mail">Contenido:</label>
              <textarea class="form-control" name="contenido_mail" id="contenido_mail" 
                        rows="10" placeholder="Ingresa el contenido del correo" required></textarea>
            </div>

            <div class="form-group text-center">
              <button type="submit" class="btn btn-primary btn-lg">Enviar Correo</button>
              <a href="{{ url('/') }}" class="btn btn-secondary btn-lg ml-2">Regresar</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection 