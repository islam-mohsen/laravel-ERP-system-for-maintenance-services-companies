@extends('layouts.main')
@section('content')

<div style="margin-top: 30px" id="store" class="tabels col-sm-12">

    <div class="card text-center ">
        <div class="card-header">
            Uncompleted Call
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
                    <th scope="col">Call Number </th>
                    <th scope="col">Created at</th>
                    <th scope="col">Call Time</th>
                    <th scope="col">Machine name</th>
                    <th scope="col">Call type</th>
                </tr>
                </thead>
                 <tbody id="myTable">
                 @foreach( $callo as $row)
                   @if ($row->servicereports->last()['job_complete'] == 0)

                       <tr class="tr">
                        <th scope="row">{{$row->id}}</th>
                        <td class="part">{{$row->call_date}}</td>
                        <td class="part">{{$row->call_time}}</td>
                        <td class="part">{{$row->machineInformation->name}}</td>
                        <td class="part">{{$row->call_type}}</td>
                    </tr>
                  @endif
                 @endforeach
                 </tbody>
            </table>

        </div>
        <div class="card-footer text-muted text-center">

        </div>
    </div>
</div>
@endsection
