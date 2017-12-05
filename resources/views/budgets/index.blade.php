@extends("layouts.app")

@section("content")

	<div class="m-1">
		<h4 class="text-center">Budget</h4>
		<Budget :data="{{$data}}"></Budget>
	</div>


@endsection