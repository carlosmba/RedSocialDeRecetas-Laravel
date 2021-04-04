@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.3/trix.css" integrity="sha512-pTg+WiPDTz84G07BAHMkDjq5jbLS/AqY0rU/QdugnfeE0+zu0Kjz++0rrtYNK9gtzEZ33p+S53S2skXAZttrug==" crossorigin="anonymous" />
@endsection

@section('botones')

<a href="{{ route('recetas.index') }}" class="btn btn-outline-primary mr-2 text-uppercase font-weight-bold">
<svg class="w-6 h-6 icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z"></path></svg>
Volver</a>

@endsection



@section('content')

<h1 class="text-center">Editar Perfil: {{ $perfil->user->name }}</h1>

<div class="row justify-content-center mt-5">
	<div class="col-md-8">
		<form action="{{ route('perfiles.update', ['perfil' => $perfil->id]) }}" enctype="multipart/form-data" method="POST" novalidate >
			@csrf

			@method('PUT')
			<div class="form-group">
				<label for="nombre">Nombre</label>
				<input type="text" id="nombre" class="form-control @error('nombre') is-invalid @enderror" placeholder="Tu Nombre" name="nombre" value="{{ $perfil->user->name }}">
			</div>
			@error('nombre')
				<span class="invalid-feedback d-block" role="alert">

					<strong>{{$message}}</strong>
				</span>
			@enderror

			<div class="form-group">
				<label for="url">URL</label>
				<input type="text" id="url" class="form-control @error('url') is-invalid @enderror" placeholder="Tu Pagina Web" name="url" value="{{ $perfil->user->url }}">
			</div>
			

			@error('url')
				<span class="invalid-feedback d-block" role="alert">

					<strong>{{$message}}</strong>
				</span>
			@enderror

			<div class="form-group mt-3">
				<label for="biografia">Biografia</label>
				<input type="hidden" id="biografia" name="biografia" value="{{ $perfil->biografia }}">
				<trix-editor input="biografia" class=" @error('biografia') is-invalid @enderror"></trix-editor>
			</div>

			@error('biografia')
				<span class="invalid-feedback d-block" role="alert">

					<strong>{{$message}}</strong>
				</span>
			@enderror

			@if ($perfil->imagen)
			<div class="mt-4">
				<p>Imagen Actual</p>
				<img src="/storage/{{ $perfil->imagen }}" alt="imagen perfil" style=" width:300px; ">
			</div>

			@endif
			<div class="form-group mt-3">
				<label for="imagen">Elige la imagen</label>
				<input type="file" id="imagen" class="form-control @error('imagen') is-invalid @enderror" name="imagen">
			</div>

			@error('imagen')
				<span class="invalid-feedback d-block" role="alert">

					<strong>{{$message}}</strong>
				</span>
			@enderror

			
			<div class="form-group mt-5">
				<input type="submit" value="Actualizar Perfil" class="btn btn-primary">
			</div>
			
		</form>
	</div>
</div>


@endsection


@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.3/trix.js" integrity="sha512-EkeUJgnk4loe2w6/w2sDdVmrFAj+znkMvAZN6sje3ffEDkxTXDiPq99JpWASW+FyriFah5HqxrXKmMiZr/2iQA==" crossorigin="anonymous" defer></script>
@endsection