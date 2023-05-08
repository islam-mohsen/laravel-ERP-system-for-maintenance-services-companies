@extends('layouts.main')
@section('content')
    <!--page contetnt-->
    <div class="card-header mx-auto">
        <M>Call Table</M>
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
            <div class="container-fluid">
                <div class="row">
                    <div class="stoc col-sm-12">
                        <div class="card text-center ">
                            <div class="card-header">
                                Coustmer call details
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="table-wrapper-scroll-y">
                                        <table class="table  table-striped table-dark">
                                            <thead>
                                            <tr>
                                                <!--        <th scope="col">#</th>-->
                                                      <th scope="col">Machine Name </th>
                                                      <th scope="col">Call number </th>
                                                      <th scope="col">Call date </th>
                                                      <th scope="col">Call time</th>
                                                      <th scope="col">View report </th>
                                                      <th scope="col">Add report</th>
                                                      <th scope="col">End Call</th>
                                                  </tr>
                                                  </thead>
                                                  <tbody>
                                                 <!--     <th scope="row">1</th>-->

                                                 @foreach($call as $calls)

                                                     <tr>
                                                      <td class="bg-danger">{{$calls->machineInformation->name}}</td>
                                                       <td class="bg-danger">{{$calls->id}}</td>
                                                           <td class="bg-danger">{{$calls->call_date}}</td>
                                                           <td class="bg-danger">{{$calls->call_time}}</td>
                                                          @if($calls->servicereports->isEmpty())
                                                             <td class="bg-danger"><button class="btn btn-primary" >No reports</button></td>
                                                            @else
                                                             <td class="bg-danger"><a class="btn btn-primary" href="{{ url('viewReport/'.$calls->id) }}">View reports</a></td>
                                                          @endif
                                                         <td class="bg-danger"><a class="btn btn-warning" href="{{ url('chooseEnginner/'.$calls->id) }}">Add report</a></td>
                                                         <td class="bg-danger"><button class="btn btn-warning">End Call</button></td>

                                                          </tr>
                                                 @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
