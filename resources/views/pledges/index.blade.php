@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <pledge-component :data="{{ $data }}"></pledge-component>
</div>

@endsection