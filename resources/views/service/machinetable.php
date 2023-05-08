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
                                                     <th scope="col">Coustmer Name </th>
                                                      <th scope="col">address </th>
                                                      <th scope="col">phone </th>
                                                      <th scope="col">telephone</th>
                                                      <th scope="col">Show reports </th>
                                                      <th scope="col">Update information</th>
                                                  </tr>
                                                  </thead>
                                                  <tbody>
                                                 <!--     <th scope="row">1</th>-->
                                                 @foreach($info as $infos)
                                                     <tr>
                                                      <td class="bg-info">{{$infos->name}}</td>
                                                       <td class="bg-info">{{$infos->address}}</td>
                                                       <td class="bg-info">{{$infos->phone}}</td>
                                                       <td class="bg-info">{{$infos->telephone}}</td>
                                                       <td class="bg-info"><a class="btn btn-warning" href="{{ url('machineReports/'.$infos->id) }}">Reports</a></td>
                                                      <td class="bg-info"><a class="btn btn-warning" href="{{ url('machineUpdate/'.$infos->id) }}">Update</a></td>
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
