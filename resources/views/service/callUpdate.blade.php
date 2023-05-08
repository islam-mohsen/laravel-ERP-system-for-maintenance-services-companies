@extends('layouts.main')
@section('content')
    <!--page contetnt-->
    <div class="card-header mx-auto">
        <M>Update Machine</M>
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
        @if(session()->has('updateCall'))
            <div class="alert alert-success">{{session()->get('updateCall')}}</div>
        @endif

          <form method="POST" action="{{route('updateCall',$update->id)}}" enctype="multipart/form-data">
              @csrf
             @method('PUT')
             <div class="form-row">
                 <div class="form-group col-md-6">
                     <label for="name">Customer Name</label>
                     <input name="name" type="text" class="form-control" id="name" placeholder="Customer Name" value="{{$update->name}}" required >
                 </div>
                 <div class="form-group col-md-6">
                     <label for="address">address</label>
                     <input name="address" type="text" class="form-control" id="address" placeholder="Address" value="{{$update->address}}" required>
                 </div>

                 <div class="form-group col-md-4">
                     <label for="telephone">Telephone Number</label>
                     <input name="telephone" type="number" class="form-control" id="telephone" placeholder="Telephone Number" value="{{$update->telephone}}">
                 </div>
                 <div class="form-group col-md-4">
                     <label for="phone">Phone Number</label>
                     <input name="phone" type="number" class="form-control" id="phone" placeholder="Phone Number" value="{{$update->phone}}">
                 </div>
                 <div class="form-group col-md-4">
                     <label for="contact_name">Contact Name</label>
                     <input name="contact_name" type="text" class="form-control" id="contact_name" placeholder="Contact Name" value="{{$update->contact_name}}">
                 </div>
                 <div class="form-group col-md-4">
                     <label for="day_of_week">Days Off</label>
                     <input name="day_of_week" type="number" class="form-control" id="day_of_week" placeholder="Inter the number of the days off" value="{{$update->day_of_week}}">
                 </div>

             <div  class="form-group col-md-4 ">
                 <label for="open_time">Start date</label>
                 <input  type="time" name="open_time" class="form-control" id="open_time" placeholder="Enter the date" value="{{$update->open_time}}">
             </div>

                 <div  class="form-group col-md-4 ">
                     <label for="close_time">Close time</label>
                     <input type="model_number" name="close_time" class="form-control" id="close_time" placeholder="Enter the date" value="{{$update->close_time}}" >
                 </div>

                 <div class="form-group col-md-4">
                     <label for="model_number">Model number</label>
                     <input name="model_number" type="number" class="form-control" id="model_number" placeholder="Model number" value="{{$update->model_number}}">
                 </div>

                 <div class="form-group col-md-4">
                     <label for="machine_serial">Machine serial</label>
                     <input name="machine_serial" type="number" class="form-control" id="machine_serial" placeholder="Machine serial" value="{{$update->machine_serial}}">
                 </div>

                 <div class="form-group col-md-4">
                     <label for="machine_place">Machine place</label>
                     <input name="machine_place" type="text" class="form-control" id="machine_place" placeholder="Machine place" value="{{$update->machine_place}}">
                 </div>

                 <div class="form-group col-md-4">
                      <label for="contract">Select Contract</label>
                         <select name="contract" class="form-control" value="{{$update->call_type}}">
                             <option value="EM">EM</option>
                             <option value="Quotation">Quotation</option>
                             <option value="Installation">Installation</option>
                             <option value="Regular Visit">Regular Visit</option>
                             <option value="Time and materials ">Time and materials </option>
                             <option value="To Complete">To Complete</option>
                         </select>
                     </div>
                 <div  class="form-group col-md-4 ">
                     <label for="contract_start">Contract start</label>
                     <input name="contract_start" type="date"  class="form-control" id="close_time" placeholder="Contract start" value="{{$update->contract_start}}">
                 </div>

                 <div  class="form-group col-md-4 ">
                     <label for="billing_period">Billing period</label>
                     <input name="billing_period" type="number"  class="form-control" id="billing_period" placeholder="Billing period" value="{{$update->billing_period}}" >
                 </div>

                 <div  class="form-group col-md-4 ">
                     <label for="minimum_charge">Minimum charge</label>
                     <input name="minimum_charge" type="number"  class="form-control" id="minimum_charge" placeholder="Minimum charge" value="{{$update->minimum_charge}}">
                 </div>

                 <div  class="form-group col-md-4 ">
                     <label for="free_copies">Free copies</label>
                     <input  name="free_copies" type="number"  class="form-control" id="free_copies" placeholder="Free copies"value="{{$update->free_copies}}" >
                 </div>

                 <div  class="form-group col-md-4 ">
                     <label for="excess_copies">Excess copies</label>
                     <input name="excess_copies" type="number"  class="form-control" id="excess_copies" placeholder="Excess_copies" value="{{$update->excess_copies}}">
                 </div>
                 <div class="form-group col-md-6">
                   <label for="engineer_id">Engineer Name</label>
                     <select name="engineer_id" class="custom-select">
                       @foreach($eng as $engo)
                       <option value="{{$engo->id}}">{{$engo->name}}</option>
                       @endforeach
                       </select>
                 </div>
                 <div  class="form-group col-md-6">
                     <label for="notes">Notes</label>
                     <input name="notes" type="textarea"  class="form-control" id="notes" placeholder="Notes" value="{{$update->notes}}">
                 </div>

                  <div>
                      <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
              </form>

          </div>
@endsection
