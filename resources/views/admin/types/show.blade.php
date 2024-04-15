@extends('layouts.app')


@section('content')
    <section>
        <div class="container">
            <a class="btn btn-primary my-4" href="{{ route('admin.types.index') }}">Torna alla lista</a>


            <h5>Dettaglio Categoria</h5>

            <h1>{{ $type->label }}</h1>
            <p>{{ $type->color }}</p>
            <p>{!! $type->getBadge() !!}</p>
             
            <h3 class="mt-5">Progetti correlati</h3>
            <table class="table">
                <thead>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Title</th>
                </thead>
                <tbody>
                    @foreach ($type->projects as $project)

                    <tr>
                        <td>{{ $project->id }}</td>
                        <td>{{ $project->title }}</td>
                        <td>
                            <a class="btn btn-primary" href="{{ route('admin.types.show', $project) }}">
                                <i class="fa-solid fa-eye"></i>
                            </a>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </section>
@endsection

{{-- Link cdn font awesome --}}
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
