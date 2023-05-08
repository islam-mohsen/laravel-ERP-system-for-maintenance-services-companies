@extends('layouts.main')
@section('css')
  <style>

</style>
@endsection
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
        <div class="card-body">
            <table class="table table-responsive scroll ">
                <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Number</th>
                    <th scope="col">phone</th>
                    <th scope="col">Telephone</th>
                    <th scope="col">Address</th>
                    <th scope="col">note</th>
                    <th scope="col">Update </th>
                    <th scope="col">Delete</th>

                </tr>
                </thead>
                 <tbody>
                 @foreach($vary as $row)
                       <tr class="tr">
                        <th scope="row">{{$row->id}}</th>
                        <td class="part">{{$row->name}}</td>
                        <td class="part">{{$row->number}}</td>
                        <td class="part">{{$row->phone}}</td>
                        <td class="part">{{$row->telephone}}</td>
                        <td class="part">{{$row->address}}</td>
                        <td class="part">{{$row->note}}</td>
                        <td class="part"><a class="btn btn-primary" href="{{route('customerUpdate',$row->id) }}">Update </a></td>
                        <td class="part"><a class="btn btn-primary" href="{{ url('deleteCustomer/'.$row->id) }}">Delete </a></td>
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
@section('js')

@endsection
