@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css" integrity="sha512-CWdvnJD7uGtuypLLe5rLU3eUAkbzBR3Bm1SFPEaRfvXXI2v2H5Y0057EMTzNuGGRIznt8+128QIDQ8RqmHbAdg==" crossorigin="anonymous" />
@endsection

@section('botones')

<a href="{{ route('recetas.index') }}" class="btn btn-outline-primary mr-2 text-uppercase font-weight-bold">
<svg class="w-6 h-6 icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z"></path></svg>
Volver</a>

@endsection



@section('content')

<h1 class="text-center">Crear Nueva Recetas</h1>

<div class="row justify-content-center mt-5">
	<div class="col-md-8">
		<form action="{{ route('recetas.store') }}" enctype="multipart/form-data" method="POST" novalidate >
			@csrf
			<div class="form-group">
				<label for="titulo">Titulo Receta</label>
				<input type="text" id="titulo" class="form-control @error('titulo') is-invalid @enderror" placeholder="Titulo Receta" name="titulo" value="{{ old('titulo') }}">
			</div>
			@error('titulo')
				<span class="invalid-feedback d-block" role="alert">

					<strong>{{$message}}</strong>
				</span>
			@enderror

			<div class="form-group">
				<label for="categoria">Categoria</label>
				<select name="categoria" id="categoria" class="form-control @error('categoria') is-invalid @enderror">
					<option value="">-- Seleccione --</option>
					@foreach ($categorias as $categoria)
					<option value="{{ $categoria->id }}" {{ old('categoria') == $categoria->id ? 'selected' : '' }} >{{ $categoria->nombre }}</option>
					@endforeach
				</select>
			</div>

			@error('categoria')
				<span class="invalid-feedback d-block" role="alert">

					<strong>{{$message}}</strong>
				</span>
			@enderror

			<div class="form-group mt-3">
				<label for="preparacion">Preparación</label>
				<input type="hidden" id="preparacion" name="preparacion" value="{{ old('preparacion') }}">
				<trix-editor input="preparacion" class="@error('preparacion') is-invalid @enderror"></trix-editor>
			</div>

			@error('preparacion')
				<span class="invalid-feedback d-block" role="alert">

					<strong>{{$message}}</strong>
				</span>
			@enderror

			<div class="form-group mt-3">
				<label for="ingredientes">Ingredientes</label>
				<input type="hidden" id="ingredientes" name="ingredientes" value="{{ old('ingredientes') }}">
				<trix-editor input="ingredientes" class="@error('ingredientes') is-invalid @enderror"></trix-editor>
			</div>

			@error('ingredientes')
				<span class="invalid-feedback d-block" role="alert">

					<strong>{{$message}}</strong>
				</span>
			@enderror

			<div class="form-group mt-3">
				<label for="imagen">Elige la imagen</label>
				<input type="file" id="imagen" class="form-control @error('ingredientes') is-invalid @enderror" name="imagen">
			</div>

			@error('imagen')
				<span class="invalid-feedback d-block" role="alert">

					<strong>{{$message}}</strong>
				</span>
			@enderror
			
			<div class="form-group mt-5">
				<input type="submit" value="Agregar Receta" class="btn btn-primary">
			</div>
			
		</form>
	</div>
</div>


@endsection


@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js" integrity="sha512-/1nVu72YEESEbcmhE/EvjH/RxTg62EKvYWLG3NdeZibTCuEtW5M4z3aypcvsoZw03FAopi94y04GhuqRU9p+CQ==" crossorigin="anonymous" defer></script>
@endsection