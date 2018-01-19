@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <data-table :data="{{ $providers }}" title="Assigned Providers">
        <table-col data-key="name" label="Name"></table-col>
        <table-col data-key="contact" label="Contact"></table-col>
        <table-col data-key="item.name" label="Item"></table-col>
        <table-col data-key="exactAmount" label="Item Total" data-type="currency"></table-col>
        <table-col data-key="paid" label="Amount Paid So far" data-type="currency"></table-col>
        <table-col data-key="balance" label="Remaining Balance" data-type="currency"></table-col>

        
    </data-table>
</div>
  
@endsection