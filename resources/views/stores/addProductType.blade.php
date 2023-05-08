@extends('layouts.main')
@section('content')
@section('css')
@endsection
<div class="card-header mx-auto">
    Add Product Type
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
    @if(session()->has('addetype'))
        <div class="alert alert-success">{{session()->get('addetype')}}</div>
    @endif
    <form action="{{route('type.add')}}" method="post">
        @csrf
        <div id="formdata" class="form-group">
            <label for="itemdescription">Product Type</label>
            <input type="text" name="type" class="form-control"  placeholder="Enter new Type">

        </div>
        <input type="submit" name="decadd" class="btn btn-primary" value='Submit'/>
    </form>
</div>
@section('js')
@endsection

@endsection
