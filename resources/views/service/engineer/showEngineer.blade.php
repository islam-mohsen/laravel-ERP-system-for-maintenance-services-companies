@extends('layouts.main')
@section('content')

<div style="margin-top: 30px" id="store" class="tabels col-sm-12">

    <div class="card text-center ">
        <div class="card-header">
            Egineers table
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
            @if(session()->has('EngineerHasStock'))
                <div class="alert alert-danger">{{session()->get('EngineerHasStock')}}</div>
             @elseif (session()->has('deleteEngineer'))
             <div class="alert alert-success">{{session()->get('deleteEngineer')}}</div>
            @endif
        <div class="card-body">
            <table class="table table-responsive ">
                <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Name</th>
                    <th scope="col">phone</th>
                    <th scope="col">telephone</th>
                    <th scope="col">Show stock</th>
                    <th scope="col">Add stock</th>
                    <th scope="col">Update info</th>

                </tr>
                </thead>
                 <tbody id="myTable">
                 @foreach($engineer as $row)
                       <tr class="tr">
                        <th scope="row">{{$row->id}}</th>
                        <td class="part">{{$row->name}}</td>
                        <td class="part">{{$row->phone}}</td>
                        <td class="part">{{$row->telephone}}</td>
                        <td class="part"><a class="btn btn-primary" href="{{ url('showEngineerStock/'.$row->id) }}">Show stock</a></td>
                        <td class="part"><a class="btn btn-primary" href="{{ url('addEngineerStock/'.$row->id) }}">Add stock</a></td>
                        <td class="part"><a class="btn btn-primary" href="{{ url('engineerUpdate/'.$row->id) }}">Update info</a></td>
                        <td class="part"><a class="btn btn-primary" href="{{ url('deleteEngineer/'.$row->id) }}">Delete Enginner</a></td>
                    </tr>
                 @endforeach
                 </tbody>
            </table>

        </div>
        <div class="card-footer text-muted text-center">

        </div>
    </div>
</div>
@endsection
