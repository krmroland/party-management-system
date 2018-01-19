@extends('layouts.app')
@section('content')
    <div class="container-fluid">
       <cards-component :data="{{ $data }}"></cards-component> 
    </div>
   
@endsection