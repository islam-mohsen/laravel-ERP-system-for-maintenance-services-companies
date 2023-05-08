@extends('layouts.main')
@section('content')
    <!--page contetnt-->
    <div class="card-header mx-auto">
        <M>{{$machine->name}}</M>
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
                              Service Reports
                          </div>
                          <div class="card-body">
                              <div class="row">
                                  <div class="table-wrapper-scroll-y">
                                      <table class="table  table-striped table-dark">
                                          <thead>
                                          <tr>
                                              <th scope="col">Visite date </th>
                                              <th scope="col">Work start </th>
                                              <th scope="col">Work end </th>
                                              <th scope="col">Cust time</th>
                                              <th scope="col">Store time</th>
                                              <th scope="col">Job complete</th>
                                              <th scope="col">Comments </th>
                                              <th scope="col">Engineer</th>
                                              <th scope="col">Spare parts</th>
                                              <th scope="col">Quantity</th>
                                          </tr>
                                          </thead>
                                          @foreach($machine->machineReport as $reporto)
                                          <tbody>
                                          <tr>
                                              <td class="bg-success">{{$reporto->visite_date}}</td>
                                              <td class="bg-success">{{$reporto->work_start}}</td>
                                              <td class="bg-success">{{$reporto->work_end}}</td>
                                              <td class="bg-success">{{$reporto->cust_time}}</td>
                                              <td class="bg-success">{{$reporto->store_time}}</td>
                                             @if($reporto->job_complete)
                                              <td class="bg-success">yes</td>
                                              @else
                                              <td class="bg-danger">No</td>
                                              @endif
                                              <td class="bg-success">{{$reporto->comments}}</td>
                                              <td class="bg-success">{{$reporto->engineers->name}}</td>
                                            @foreach($reporto->prd as $reprd)
                                              <td class="bg-success">{{$reprd->part_num}}</td>
                                              <td class="bg-success">{{$reprd->pivot->quantity}}</td>
                                              @endforeach
                                          </tr>
                                          </tbody>
                                              @endforeach
                                      </table>
                                  </div>
                              </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
