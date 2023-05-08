@extends('layouts.main')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
@section('css')
@endsection
<div class="card-header mx-auto">
    Add customer
</div>
<div class="card-body">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if(session()->has('addCustomer'))
        <div class="alert alert-success">{{session()->get('addCustomer')}}</div>
    @endif
    <form action="{{route('customer.store')}}" method="post" enctype="multipart/form-data" id="prod">
        {{csrf_field()}}
        <div id="formdata" class="form-group">
            <label for="name">Customer name</label>
            <input name="name" type="text" class="form-control" id="name"
             placeholder="Enter the name ">
        </div>
        <div  class="form-group">
            <label for="number">Number</label>
            <input name="number" type="text" class="form-control" placeholder="Enter the Number ">
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input name="address" type="text" class="form-control" id="address" placeholder="Address ">
        </div>
        <div class="form-group">
            <label for="Mobilenumber">Mobile Number</label>
            <input name="phone" type="text" class="form-control" id="Mobilenumber" placeholder="mobile">
        </div>

        <div class="form-group">
            <label for="Telephonenumber">Telephone Number</label>
            <input name="telephone" type="text" class="form-control" id="Telephonenumber" placeholder="telephone">
        </div>

        <div class="form-group">
            <label for="note">Note</label>
            <input name="note" type="text" class="form-control" id="note" placeholder="note">
        </div>

        <input type="submit" class="btn btn-primary" value="Submit"/>
    </form>
</div>

@section('js')
@endsection
@endsection
