@foreach($votadas as $votada)
<div class="col-md-4 mt-4">
	<div class="card shadow">
		<img class="card-img-top" src="/storage/{{ $votada->imagen }}" alt="imagen receta">
		<div class="card-body">
			<h3 class="card-title">{{$votada->titulo}}</h3>
			<div class="meta-receta d-flex justify-content-between">
				@php
				$fecha = $votada->created_at;	

				@endphp
				<p class="text-primary fecha font-weight-bold">
					<date-recipe date="{{$fecha}}"></date-recipe>
				</p>
				<p>{{ count($votada->likes) }} Les gustó</p>
			</div>
			<p>{{ Str::words( strip_tags($votada->preparacion), 10, '...') }}</p>
			<a  class="btn btn-primary d-block font-weight-bold text-uppercase btn-receta" href="{{ route('recetas.show', ['receta' => $votada->id]) }}">Ver Receta</a>
		</div>
	</div>

</div>
@endforeach