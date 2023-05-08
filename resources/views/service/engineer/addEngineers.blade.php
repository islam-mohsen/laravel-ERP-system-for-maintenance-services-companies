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
        <form action="{{route('addEngineers.store')}}" method="post" enctype="multipart/form-data" id="addEngineers">
            {{csrf_field()}}
            <div calss="form">
                <div class="form-group">
                    <div id="formdata" class="form-group">
                        <label for="name">Engineer name</label>
                        <input type="text" name="name" class="form-control" id="Suppliername" ">

                    </div>
                    <div class="form-group">
                        <label for="address">address</label>
                        <input type="text"  name="address" class="form-control" id="address" placeholder="Address ">
                    </div>
                    <div class="form-group">
                        <label for="phone">phone</label>
                        <input type="text" name="phone" class="form-control" id="Mobilenumber" placeholder="mobile">
                    </div>

                    <div class="form-group">
                        <label for="telephone">telephone</label>
                        <input type="text" name="telephone" class="form-control" id="Telephonenumber" placeholder="telephone">
                    </div>
                <input type="submit" class="btn btn-primary" value="Submit"/>
            </div>
        </form>
    </div>
@endsection
