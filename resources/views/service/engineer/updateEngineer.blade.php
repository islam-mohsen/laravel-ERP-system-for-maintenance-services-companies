@extends('layouts.main')
@section('content')
    <div class="card-header mx-auto">
        <M>Add Engineer </M>
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
        @if(session()->has('updateEngineer'))
            <div class="alert alert-success">{{session()->get('updateEngineer')}}</div>
        @endif

        <form action="{{route('engineerUpdate',$engineer->id)}}" method="post">
          @csrf
         @method('PUT')
            <div calss="form">
                <div class="form-group">
                    <div id="formdata" class="form-group">
                        <label for="name">Engineer name</label>
                        <input type="text" name="name" class="form-control" value="{{$engineer->name}}">

                    </div>
                    <div class="form-group">
                        <label for="address">address</label>
                        <input type="text"  name="address" class="form-control" id="address" placeholder="Address" value="{{$engineer->address}}">
                    </div>
                    <div class="form-group">
                        <label for="phone">phone</label>
                        <input type="text" name="phone" class="form-control"  placeholder="phone"  value="{{$engineer->phone}}">
                    </div>

                    <div class="form-group">
                        <label for="telephone">telephone</label>
                        <input type="text" name="telephone" class="form-control" id="Telephonenumber" placeholder="telephone" value="{{$engineer->telephone}}">
                    </div>
                <input type="submit" class="btn btn-primary" value="Submit"/>
            </div>
        </form>
    </div>
@endsection
