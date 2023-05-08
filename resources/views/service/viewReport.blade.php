@extends('layouts.main')
@section('content')
    <!--page contetnt-->
    <div class="card-header mx-auto">
        <M>reports for call {{$call->id}}</M>
    </div>
    <div class="card-body">
         <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card text-center ">
                        <div class="card-header">
                            Call informations
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="table-wrapper-scroll-y">
                                    <table class="table  table-striped table-dark">
                                        <thead>
                                        <tr>
                                            <th scope="col">Machine Name </th>
                                            <th scope="col">Call number </th>
                                            <th scope="col">Call date </th>
                                            <th scope="col">Call time</th>
                                            <th scope="col">Problem</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                       <tr>
                                            <td class="bg-danger">{{$call->machineInformation->name}}</td>
                                            <td class="bg-danger">{{$call->id}}</td>
                                            <td class="bg-danger">{{$call->call_date}}</td>
                                            <td class="bg-danger">{{$call->call_time}}</td>
                                           <td class="bg-danger">{{$call->problem}}</td>
                                       </tr>
                                     </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!------------------------- machine information--------------->

                    <div class="card text-center ">
                        <div class="card-header">
                            Machine informations
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="table-wrapper-scroll-y">
                                    <table class="table  table-striped table-dark">
                                        <thead>
                                        <tr>
                                            <th scope="col">Contact name </th>
                                            <th scope="col">Telephome NO. </th>
                                            <th scope="col">Days of </th>
                                            <th scope="col">Open time</th>
                                            <th scope="col">Address</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td class="bg-info">{{$call->machineInformation->contact_name}}</td>
                                            <td class="bg-info">{{$call->machineInformation->day_of_week}}</td>
                                            <td class="bg-info">{{$call->machineInformation->open_time}}</td>
                                            <td class="bg-info">{{$call->machineInformation->close_time}}</td>
                                            <td class="bg-info">{{$call->machineInformation->address}}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!------------------------- service reports--------------->

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
                                            <th scope="col">visite date </th>
                                            <th scope="col">work start </th>
                                            <th scope="col">work end </th>
                                            <th scope="col">cust time</th>
                                            <th scope="col">store time</th>
                                            <th scope="col">job complete</th>
                                            <th scope="col">comments </th>
                                            <th scope="col">Engineer</th>
                                            <th scope="col">Spare parts</th>
                                            <th scope="col">Quantity</th>
                                        </tr>
                                        </thead>
                                        @foreach($call->serviceReports as $reporto)
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
    </div>

@endsection
