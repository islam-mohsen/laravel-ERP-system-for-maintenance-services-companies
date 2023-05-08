@extends('layouts.main')
@section('content')
@section('css')
@endsection
<div class="card-header mx-auto">
    Brand Name Data
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
    @if(session()->has('addedbrand'))
        <div class="alert alert-success">{{session()->get('addedbrand')}}</div>
    @endif
    <form action="{{route('brand.add')}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <div id="formdata" class="form-group">
            <label for="brandname">Brand Name</label>
            <input name="name" type="text" class="form-control" id="brandname" aria-describedby="emailHelp"
                   placeholder="Enter the name ">

        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroupFileAddon01">Default Image</span>
            </div>
            <div class="custom-file">
                <input name="img" type="file" class="custom-file-input" id="inputGroupFile01"
                       aria-describedby="inputGroupFileAddon01">
                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
            </div>
        </div>
        <input type="submit" name="brandadd" class="btn btn-primary" value='Submit'/>
    </form>
</div>
@section('js')
@endsection

@endsection
