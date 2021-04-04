@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.3/trix.css" integrity="sha512-pTg+WiPDTz84G07BAHMkDjq5jbLS/AqY0rU/QdugnfeE0+zu0Kjz++0rrtYNK9gtzEZ33p+S53S2skXAZttrug==" crossorigin="anonymous" />
@endsection

@section('botones')

<a href="{{ route('recetas.index') }}" class="btn btn-primary mr-2 text-white">Volver</a>

@endsection



@section('content')

<h1 class="text-center">Editar Receta: {{ $receta->titulo }}</h1>

<div class="row justify-content-center mt-5">
	<div class="col-md-8">
		<form action="{{ route('recetas.update', ['receta' => $receta->id]) }}" enctype="multipart/form-data" method="POST" novalidate >
			@csrf

			@method('PUT')
			<div class="form-group">
				<label for="titulo">Titulo Receta</label>
				<input type="text" id="titulo" class="form-control @error('titulo') is-invalid @enderror" placeholder="Titulo Receta" name="titulo" value="{{ $receta->titulo }}">
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
					<option value="{{ $receta->categoria_id }}" {{ $receta->categoria_id == $categoria->id ? 'selected' : '' }} >{{ $categoria->nombre }}</option>
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
				<input type="hidden" id="preparacion" name="preparacion" value="{{ $receta->preparacion }}">
				<trix-editor input="preparacion" class="form-control @error('preparacion') is-invalid @enderror"></trix-editor>
			</div>

			@error('preparacion')
				<span class="invalid-feedback d-block" role="alert">

					<strong>{{$message}}</strong>
				</span>
			@enderror

			<div class="form-group mt-3">
				<label for="ingredientes">Ingredientes</label>
				<input type="hidden" id="ingredientes" name="ingredientes" value="{{ $receta->ingredientes }}">
				<trix-editor input="ingredientes" class="form-control @error('ingredientes') is-invalid @enderror"></trix-editor>
			</div>

			@error('ingredientes')
				<span class="invalid-feedback d-block" role="alert">

					<strong>{{$message}}</strong>
				</span>
			@enderror

			<div class="mt-4">
				<p>Imagen Actual</p>
				<img src="/storage/{{ $receta->imagen }}" alt="imagen receta" style=" width:300px; ">
			</div>


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
				<input type="submit" value="Actualizar Receta" class="btn btn-primary">
			</div>
			
		</form>
	</div>
</div>


@endsection


@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.3/trix.js" integrity="sha512-EkeUJgnk4loe2w6/w2sDdVmrFAj+znkMvAZN6sje3ffEDkxTXDiPq99JpWASW+FyriFah5HqxrXKmMiZr/2iQA==" crossorigin="anonymous" defer></script>
@endsection