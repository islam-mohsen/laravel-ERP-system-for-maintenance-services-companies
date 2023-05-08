@extends('layouts.main')
@section('content')
@section('css')
@endsection
<div class="card-header mx-auto">
    Edit Proudct Quantity
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
    <form action="{{route('quantity.edit.post',[$id])}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <div id="formdata" class="form-group">
            <label for="brandname">Quantity</label>
            <input name="quantity" type="text" class="form-control" id="brandname" aria-describedby="emailHelp"
                   placeholder="{{$quantity->quantity}}">
        </div>
        <input type="submit" name="brandadd" class="btn btn-primary" value='Submit'/>
    </form>
</div>

@section('js')
@endsection

@endsection
