@extends('layouts.app')

@section('botones')

@include('ui.navigation')

@endsection


@section('content')
<h2 class="text-center mb-5">Administra tus recetas</h2>

<div class="col-md-10 mx-auto bg-white p-3">
	<table class="table">
		<thead class="bg-primary text-leght">
			<tr>
				<th scole="col">Titulo</th>
				<th scole="col">Categoría</th>
				<th scole="col">Acciones</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($recetas as $receta)
				<tr>
					<th>{{$receta->titulo}}</th>
					<th>{{$receta->categoria->nombre}}</th>
					<th> 
						<delete-recipe receta-id="{{ $receta->id }}"></delete-recipe>
						<a href="{{ route('recetas.edit', ['receta' => $receta->id]) }}" class="btn btn-dark d-block mb-2">Editar</a>
						<a href="{{ route('recetas.show', ['receta' => $receta->id]) }}" class="btn btn-success d-block mb-2">Ver</a> 
					</th>
				</tr>
			@endforeach
		</tbody>

	</table>
	<div class="col-12 mt-4 justify-content-center d-flex">
		{{ $recetas->links() }}
	</div>

	<h2 class="text-center my-5">Recetas que te gustan</h2>

	@if (count($usuario->iLike) > 0)
	<div class="col-md-10 mx-auto bg-white p-3">
		<ul class="list-group">
			@foreach($usuario->iLike as $receta)
				<li class="list-group-item d-flex justify-content-between align-items-center">
					<p>{{ $receta->titulo }}</p>
					<a 
					class="btn btn-outline-success text-uppercase font-weight-bold" 
					href=" {{ route('recetas.show', ['receta' => $receta->id]) }} " >Ver</a>
				</li>
			@endforeach
		</ul>
	</div>
	@else
	<p class="text-center">Aún no tienes recetas Guardadas <small>Dale me gusta a las recetas y aparecerán aquí</small> </p>
	@endif
</div>

@endsection