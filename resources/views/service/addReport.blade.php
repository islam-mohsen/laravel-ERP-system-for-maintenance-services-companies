@extends('layouts.main')
@section('content')
    <div class="card-header mx-auto">
        <M>add Report</M>
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
        @if(session()->has('addedReport'))
            <div class="alert alert-success">{{session()->get('addedReport')}}</div>
        @endif
        <div class="card-body">
            <div class="row">
                <div class="table-wrapper-scroll-y">
                    <table class="table  table-striped table-primary">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">Call type </th>
                            <th scope="col">Call number </th>
                            <th scope="col">Call date </th>
                            <th scope="col">Call time </th>
                              </tr>
                          </thead>
                      <tbody>
                           <tr>
                              <td class="">{{$call->call_type }}</td>
                               <td class="">{{$call->id}}</td>
                               <td class="">{{$call->call_date}}</td>
                               <td class="">{{$call->call_time}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!--- machineInformation table -->
            <div class="row">
                <div class="table-wrapper-scroll-y">
                    <table class="table  table-striped table-success">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">Machine Name </th>
                            <th scope="col">address </th>
                            <th scope="col">phone </th>
                            <th scope="col">telephone </th>
                              </tr>
                          </thead>
                      <tbody>
                           <tr>
                              <td class="">{{$call->machineInformation->name}}</td>
                               <td class="">{{$call->machineInformation->address}}</td>
                               <td class="">{{$call->machineInformation->phone}}</td>
                               <td class="">{{$call->machineInformation->telephone}}</td>
                            </tr>
                        </tbody>
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col">contact name </th>
                            <th scope="col">day of week </th>
                            <th scope="col">open time </th>
                            <th scope="col">close time </th>
                            </tr>
                          </thead>
                          <tbody>
                               <tr>
                           <td class="">{{$call->machineInformation->contact_name}}</td>
                          <td class="">{{$call->machineInformation->day_of_week}}</td>
                          <td class="">{{$call->machineInformation->open_time}}</td>
                          <td class="">{{$call->machineInformation->close_time}}</td>
                                </tr>
                            </tbody>

                    </table>
                </div>
            </div>
        <form action="{{route('saveReport',[$call->id,$eng->id])}}" method="post" enctype="multipart/form-data" id="addReport">
            {{csrf_field()}}
            <div calss="form">
                <div class="form-row">
                    <div  class="form-group col-md-4 ">
                        <label for="visite_date">Visit date</label>
                        <input name="visite_date" type="date"  class="form-control" id="close_time" placeholder="Visit date" >
                    </div>
                    <div class="form-group col-md-6">
                        @if ($reporto)
                        <label for="meter_reading" id="meter" >Last Meter reading = {{$reporto->meter_reading}}</label>
                      @else
                        <label for="meter_reading">Last Meter reading = no meter reading</label>
                      @endif
                        <input name="meter_reading" type="number" class="form-control"  placeholder="meter reading" >
                    </div>

                    <div  class="form-group col-md-6 ">
                        <label for="work_start">Work start</label>
                        <input  type="time" name="work_start" class="form-control" id="work_start" placeholder="work start" >

                    </div>

                    <div  class="form-group col-md-6 ">
                        <label for="work_end">Work end</label>
                        <input type="time" name="work_end" class="form-control" id="work_end" placeholder="work end" >
                    </div>

                    <div  class="form-group col-md-6 ">
                        <label for="cust_time">Customer time</label>
                        <input name="cust_time" type="number"  class="form-control" id="close_time" placeholder="Enter number of minutes" >
                    </div>

                    <div  class="form-group col-md-6 ">
                        <label for="store_time"> Store time </label>
                        <input name="store_time" type="number"  class="form-control" id="store_time" placeholder="Enter number of minutes" >
                    </div>

                    <div  class="form-group col-md-12">
                        <label for="comments">Comments</label>
                        <textarea  name="comments" type="textarea"  class="form-control" id="comments" placeholder="comments" rows="3"></textarea>
                    </div>

                  </br>

                    <div class="form-group col-md-12">
                        <label for="job_complete">job copmlete</label>
                        <select name="job_complete" class="form-control">
                            <option value=0>uncompleted</option>
                            <option value=1>completed</option>
                        </select>
                    </div>
                   <!-- table add product --->
                 <div class="table-responsive">
                 <table class="table  table-striped" id="dynamic">
                   <div class="form-group col-md-12">
                     <h4>Please add the products to Engineer stock first</h4>
                     <h5 >You can add engineer stock from engineer table &#128516;</h5>
                   </div>
                 <thead>
                   <tr>
                     <th scope="col">Part number</th>
                       <th scope="col">Quantity</th>
                         <th scope="col"><input type="button" class="btn btn-primary addRow" id="add" value="Add Product"/></th>
                           </tr>
                 </thead>
                   <br>
                     <tbody class="addtable">
                       <tr class="tr">
                         <td class="eng">
                             <div class="form-group">
                                 <select id="PartNumber" name="product_id[]" class="custom-select" >
                                   @foreach($eng->products as $part)
                                   <option value="{{$part->id}}">{{$part->part_num}}</option>
                                   @endforeach
                                   </select>
                             </div>
                         </td>
                           <td class="eng">
                             <div class="form-group">
                               <input name="quantity[]" type="number" class="form-control" id="quantity" placeholder="quantity">
                             </div>
                         </td>
                          <td class="eng"><input type="button" class="btn btn-danger remove" id="add" value="Remove Product"/>
                         </td>
                         </tr>
                       </tbody>
                   </table>
               </div>
             <!--- table end--->
                <input type="submit" class="btn btn-primary" value="Submit"/>
            </div>
        </form>
    </div>
@endsection
@section('js')
    <script>
        $('.addRow').on('click', function () {
            addRow();
        });
        function addRow() {
            var tr = '<tr class="tr">'+
                ' <td class="eng">'+
                ' <div class="form-group">'+
                ' <select id="PartNumber" name="product_id[]" class="custom-select" >'+
                '@foreach($prd as $part)'+
                '<option value="{{$part->id}}">{{$part->part_num}}</option>'+
                '@endforeach'+
                ' </select>'+
                ' </div>'+
                ' </td>'+

                '<td class="eng">'+
                '<div class="form-group">'+
                '<input name="quantity[]" type="number" class="form-control" id="quantity" placeholder="quantity">'+
                ' </div>'+
                ' </td>'+
                ' <td class="eng"><input type="button" class="btn btn-danger remove" id="add" value="Remove Product"/>'+
                ' </td>'+
                ' </tr>';

                $('.addtable').append(tr);
        };
        $('tbody').on('click','.remove' , function () {
      $(this).parent().parent().remove();
        });
  </script>
@endsection
