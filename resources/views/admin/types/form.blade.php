@extends('layouts.app')

@section('content')
  <section>
    <div class="container">
      
      <a class="btn btn-primary my-4" href="{{ route('admin.types.index') }}">Torna alla lista</a>
      
      <h1>Form Categoria</h1>

      <form action="{{ route('admin.types.store') }}" class="row" method="POST">
        @csrf

        <div class="col-1">
          <label for="color">Colore</label>
          <input class="form-control" id="color" name="color" type="color">
        </div>
        
        <div class="col-11">
          <label for="label">Etichetta</label>
          <input class="form-control" id="label" name="label" type="text">
        </div>

        <div class="col-12 mt-2">
          <button type="submit" class="btn btn-success">Salva</button>
        </div>

      </form>
    </div>
  </section>
@endsection
