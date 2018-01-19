@extends("layouts.app")

@section("content")
<div class="container-fluid">
   <div class="card">
       <div class="card-body">
           <Budget :data="{{$data}}"></Budget>
       </div>
      
   </div>
    
</div>



@endsection