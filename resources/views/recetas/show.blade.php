@extends('layouts.app')

@section('content')




	<article class="content-recipe bg-white p-5">

	{{-- <h1>{{$receta}}</h1> --}}

		<h1 class="text-center mb-4"> {{$receta->titulo}} </h1>
		<div class="image">
			<img src="/storage/{{ $receta->imagen }}" alt="Imagen-receta">
		</div>

		<div class="recipe-meta mt-4">
			<p><span class="font-weight-bold text-primary">Escrito en:</span> <a class="text-dark" href="{{ route('categorias.show', ['categoriaReceta' => $receta->categoria->id]) }}"> {{$receta->categoria->nombre}} </a></p>
			<p><span class="font-weight-bold text-primary">Autor:</span> <a class="text-dark" href="{{ route('perfiles.show', ['perfil' => $receta->autor->id]) }}"> {{$receta->autor->name}} </a> </p>

			<p><span class="font-weight-bold text-primary">Fecha:</span>

				@php
				$fecha = $receta->created_at;	

				@endphp

				<date-recipe date="{{$fecha}}"></date-recipe>

			</p>
			<div class="ingredients">
				<h2 class="my-3 text-primary">Ingredientes</h2>

				{!! $receta->ingredientes !!}

			</div>

			<div class="preparation">
				<h2 class="my-3 text-primary">Preparación</h2>

				{!! $receta->preparacion !!}

			</div>
				<like-button 
				receta-id="{{ $receta->id }}" 
				like="{{ $like }}"
				likes = "{{ $likes }}"
				></like-button>
		</div>
	</article>

@endsection