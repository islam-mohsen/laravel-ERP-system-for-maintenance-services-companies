@extends('layouts.main')
@section('content')
    <div class="card-header mx-auto">
        <M>Update customer </M>
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
        @if(session()->has('updateCustomer'))
            <div class="alert alert-success">{{session()->get('updateCustomer')}}</div>
        @endif

        <form action="{{route('customerUpdate',$vary->id)}}" method="post">
          @csrf
         @method('PUT')
            <div calss="form">
                <div class="form-group">
                    <div id="formdata" class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" value="{{$vary->name}}">
                    </div>
                    <div id="formdata" class="form-group">
                        <label for="name">Number</label>
                        <input type="number" name="number" class="form-control" value="{{$vary->number}}">
                    </div>
                    <div class="form-group">
                        <label for="phone">phone</label>
                        <input type="text" name="phone" class="form-control"  placeholder="phone"  value="{{$vary->phone}}">
                    </div>

                    <div class="form-group">
                        <label for="telephone">telephone</label>
                        <input type="text" name="telephone" class="form-control" id="Telephonenumber" placeholder="telephone" value="{{$vary->telephone}}">
                    </div>
                    <div class="form-group">
                        <label for="address">address</label>
                        <input type="text"  name="address" class="form-control" id="address" placeholder="Address" value="{{$vary->address}}">
                    </div>

                <input type="submit" class="btn btn-primary" value="Submit"/>
            </div>
        </form>
    </div>
@endsection
