@extends('layouts.app')


@section('content')
<div class="container">
				<h2 class="titulo-categoria text-uppercase my-4">Resultados de la Busqueda: {{$busqueda}}</h2>
				<div class="row">
					@include('ui.categorias')
				</div>
				{{ $recetas->links() }}
			</div>
@endsection()