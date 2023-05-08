@extends('layouts.main')
@section('content')
    <!--page contetnt-->
    <div class="card-header mx-auto">
        <M>enginner  Table</M>
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
                              <h3>  Choose engineer first please </h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="table-wrapper-scroll-y">
                                        <table class="table  table-striped table-dark">
                                            <thead>
                                            <tr>
                                                      <th scope="col">Engineer Name </th>
                                                      <th scope="col">Engineer number </th>
                                                      <th scope="col">Add report</th>
                                                  </tr>
                                                  </thead>
                                                  <tbody>
                                                 @foreach($eng as $engo)
                                                     <tr>
                                                      <td class="bg-info">{{$engo->name}}</td>
                                                       <td class="bg-info">{{$engo->telephone}}</td>
                                                       <td class="bg-info"><a class="btn btn-warning" href="{{ url('addReport/'.$call->id.'/'.$engo->id) }}">Add report</a></td>
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
