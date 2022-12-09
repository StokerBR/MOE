@php

	$sessions = [
		[ "type" => "success", "class" => "alert-success" ],
		[ "type" => "error", "class" => "alert-danger" ],
		[ "type" => "warning", "class" => "alert-warning" ],
	];

@endphp

<div class="alert-container">

	@foreach ($sessions as $session)

		@if (Session::has($session['type']))

			<div class="alert {{ $session['class'] }} animated fadeInDown">
				<div class="texts"><p>{!! Session::get($session['type']) !!}</p></div>
				<button type="button" class="btn-close">
					<i class="fas fa-times"></i>
				</button>
			</div>

		@endif

	@endforeach

	@if (count($errors) > 0)

		<div class="alert alert-danger animated fadeInDown">
			<div class="texts"><p>{{ $errors->all()[0] }}</p></div>
			<button type="button" class="btn-close">
				<i class="fas fa-times"></i>
			</button>
		</div>

	@endif

</div>
