@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card col-md-6 mx-auto">
        <div class="card-body">
            <h4 class="card-title text-center">Create A new Pledge</h4>
            <form action="{{ route('pledges.store') }}" method="POST">
                {{ csrf_field() }}
               <!--  date -->
                <div class="form-group">
                   <label>Date</label> 
                   <date-component></date-component>
                   @if ($errors->has('date'))
                       <p class="text-danger">
                           {{ $errors->first('date') }}
                       </p>
                   @endif
                </div>
                <!-- name -->
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control">
                    @if ($errors->has('name'))
                        <p class="text-danger">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>
                 <!-- amount -->               
                <div class="form-group">
                    <label>Pledge/Contribution</label>
                    <input type="number" name="amount" class="form-control">
                    @if ($errors->has('amount'))
                        <p class="text-danger">
                            {{ $errors->first('amount') }}
                        </p>
                    @endif
                </div>
                <!-- paid -->
                <div class="form-group">
                    <label>Paid</label>
                    <input type="number" name="paid" class="form-control">
                    @if ($errors->has('paid'))
                        <p class="text-danger">
                            {{ $errors->first('paid') }}
                        </p>
                    @endif
                </div>
                <!-- contact -->
                <div class="form-group">
                    <label>Contact</label>
                    <input type="text" name="contact" class="form-control">
                    @if ($errors->has('contact'))
                        <p class="text-danger">
                            {{ $errors->first('contact') }}
                        </p>
                    @endif
                </div>
                <!-- save -->                    
                <div class="form-group mt-5">
                    <button class="btn btn-primary ">
                        <i class="fa fa-save"></i>
                        Save Pledge
                    </button>
                </div>
           
            </form>
        </div>
    </div>
</div>

@endsection