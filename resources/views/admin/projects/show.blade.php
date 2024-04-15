@extends('layouts.app')

@section('content')
    <section>
        <div class="container">
            <h1>Dettaglio progetto</h1>
            {{-- @dump($projects) --}}

            <p><strong>Titolo: </strong>{{ $project->title }}</p>
            <p><strong>Tipo di progetto: </strong>{{ $project->type->label }}</p>
            <p><strong>Descrizione: </strong>{{ $project->content }}</p>
            <p><strong>Categoria: </strong>{!! $project->type->getBadge() !!}</p>
            <p><strong>Link al progetto: </strong>{{ $project->link }}</p>
            <p>
                {{ $project->getTechnologiesToText() }}
            </p>

            @if(!empty($project->image))
                <img src="{{ asset('storage/' . $project->image) }}" alt="">
            @endif

        </div>
        
        <div class="container">
            <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-warning my-3">Modifica</a>
        </div>

    </section>
@endsection
