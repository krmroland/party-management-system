@extends('layouts.app')
@section('content')
<div class="container-fluid">
   <expenditures-component :data="{{ $expenditures }}"></expenditures-component> 
</div>
    
@endsection