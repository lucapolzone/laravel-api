@extends('layouts.app')

@section('title', 'Lista progetti')

@section('content')
    <section>
        <div class="container">
            <h1>Lista progetti</h1>
            {{-- @dump($projects) --}}

            <table class="table">
                <thead>
                    <th scope="col">Titolo progetto</th>
                    <th scope="col">Categoria</th>
                    <th scope="col" class="text-center">Tecnologie usate</th>
                    <th scope="col">Descrizione</th>
                    <th scope="col">Link esterno al progetto</th>
                    <th scope="col" class="text-center">Mostra in pagina</th>
                    <th scope="col" class="text-center">Modifica in pagina</th>
                    <th scope="col" class="text-center">Elimina dalla lista</th>
                </thead>

                <tbody>

                    @forelse ($projects as $project)
                        <tr>
                            <td>{{ $project->title }}</td>
                            <td>{!! $project->type->getBadge() !!}</td> {{-- dietro questa sintassi c'è una JOIN sul db. È possibile grazie alla relazione nei Models --}}
                            <td>{{ $project->getTechnologiesToText() }}</td>
                            <td>{{ $project->content }}</td>
                            <td>
                                <a href="{{ $project->link }}" target="_blank">Link</a>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.projects.show', $project) }}">
                                    <i class="fa-solid fa-eye" style="color: Dodgerblue;"></i>
                                </a>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.projects.edit', $project) }}">
                                    <i class="fa-solid fa-pen" style="color: orange;"></i>
                                </a>
                            </td>
                            <td class="text-center">
                                <!-- Button trigger modal -->
                                <button type="button" class="bin-button" data-bs-toggle="modal" data-bs-target="#delete-project-{{ $project->id }}-modal">
                                    <i class="fa-solid fa-trash text-danger"></i>
                                </button>
                            </td>
                            
                        </tr>

                    @empty
                        <tr>
                            <td>Nessun risultato</td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
            {{ $projects->links('pagination::bootstrap-5') }}
        </div>
    </section>
@endsection

@section('modal')
    @foreach ($projects as $project)
    <!-- Modal -->
    <div class="modal fade" id="delete-project-{{ $project->id }}-modal" tabindex="-1" aria-labelledby="delete-project-{{ $project->id }}-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Elimina il Progetto {{ $project->title }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Sei sicuro? Non potrai tornare indietro
                </div>
                <div class="modal-footer">
                    <form action="{{ route('admin.projects.destroy', $project) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">
                            Conferma eliminazione
                        </button>
                    </form>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                </div>
            </div>
        </div>
  </div>
    @endforeach
@endsection



{{-- Link cdn font awesome --}}
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
