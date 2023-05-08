@extends('layouts.main')
@section('content')
@section('css')
@endsection
<div class="card-header mx-auto">
    Item Description Data
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
    @if(session()->has('addeddec'))
        <div class="alert alert-success">{{session()->get('addeddec')}}</div>
    @endif
    <form action="{{route('dec.add')}}" method="post">
        @csrf
        <div id="formdata" class="form-group">
            <label for="itemdescription">Item Description</label>
            <input type="text" name="dec" class="form-control" id="itemdescription" aria-describedby="emailHelp"
                   placeholder="Enter Description">

        </div>
        <input type="submit" name="decadd" class="btn btn-primary" value='Submit'/>
    </form>
</div>
@section('js')
@endsection

@endsection
