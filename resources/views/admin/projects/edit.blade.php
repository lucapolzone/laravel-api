@extends('layouts.app')

@section('content')
    <section>
        <div class="container">
            <h1>Modifica il progetto</h1>
            <form action="{{ route('admin.projects.update', $project) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="mb-3">
                  <label class="form-label" for="title">Titolo progetto</label>
                  <input class="form-control @error('title') is-invalid @enderror" value="{{ old('title') ?? $project->title }}" type="text" id="title" name="title">
                  @error('title')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>

                <div class="col-7" style="max-width: 655px">
                  <div @class(['is-invalid' => $errors->has('technologies')])>
                    @foreach($technologies as $technology)

                    {{-- Controlla se technology->id c'è nell'array degli id delle technologies selezionate prima (utilizzando la funzione old) o nell'array degli id delle technologies associate al progetto.
                    Se l'id c'è, imposta l'attributo "checked" dell'input, altrimenti lo lascia vuoto. --}}
                      <input {{ in_array($technology->id, old('technologies', $project_technologies_id ?? [])) ? 'checked' : '' }} @class(['form-check-input', 'is-invalid' => $errors->has('technologies')]) id="technologies-{{ $technology->id }}" name="technologies[]" type="checkbox" value="{{ $technology->id }}">
                      <label class="form-check-label me-2" for="technologies-{{ $technology->id }}">{{ $technology->label }}</label>
                    @endforeach
                  </div>
                  @error('technologies')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>

                <div class="mb-3">
                  <label class="form-label" for="content">Descrizione progetto</label>
                  <textarea class="form-control @error('content') is-invalid @enderror" type="text" id="content" name="content">{{ old('content') ?? $project->content }}</textarea>
                  @error('content')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>

                <div class="col-12">
                  <div class="mb-3">
                    <label class="form-label" for="image">Immagine post</label>
                    <input @class(['form-control', 'is-invalid' => $errors->has('image')]) id="image" class="form-control" name="image" type="file">
                  </div>
                </div>


                <div class="mb-3">
                  <label class="form-label" for="link">Link progetto</label>
                  <input class="form-control @error('link') is-invalid @enderror" value="{{ old('link') ?? $project->link }}" type="url" id="link" name="link">
                  @error('link')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>

                <div class="mb-3">
                    <label for="select" class="form-label">Categoria</label>
                    <select class="form-select @error('type_id') is-invalid @enderror" id="type_id" name="type_id">
                      <option value="">Seleziona una categoria</option>

                      @foreach($types as $type)
                        <option value="{{ $type->id }}">{{ $type->label }}</option>
                      @endforeach
                    </select>
                    @error('type_id')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>

                
                <button type="submit" class="btn btn-success">Salva</button>
              </form>

        </div>
    </section>
@endsection
