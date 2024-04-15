@extends('layouts.app')

@section('title', 'Lista categorie')

@section('content')
	<section>
    	<div class="container">
            <h1>Lista categorie</h1>
			
			<table class="table mb-4">
				<thead>
					<tr>
						<th>ID</th>
						<th>Etichetta</th>
						<th>Colore</th>
						<th>Badge</th>
						<th class="text-center">Mosta categoria</th>
					</tr>
				</thead>
				<tbody>
					@forelse($types as $type)
						<tr>
							<td>{{ $type->id }}</td>
							<td>{{ $type->label }}</td>
							<td>{{ $type->color }}</td>
							<td>{!! $type->getBadge() !!}</td>
							<td class="text-center">
								<a href="{{ route('admin.types.show', $type) }}">
                                    <i class="fa-solid fa-eye" style="color: Dodgerblue;"></i>
                                </a>
							</td>
						</tr>

					@empty
						<tr>
							<td>
								Nessun risultato trovato
							</td>
						</tr>
					@endforelse
				</tbody>
			</table>

		</div>
@endsection


{{-- Link cdn font awesome --}}
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection