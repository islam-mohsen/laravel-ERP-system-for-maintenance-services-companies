@extends('layouts.main')
@section('content')
<div class="card-header mx-auto">
        <M>machine inormation</M>
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
    @if(session()->has('addedMachine'))
        <div class="alert alert-success">{{session()->get('addedMachine')}}</div>
    @endif
      <form action="{{route('addMachine.store')}}" method="post" enctype="multipart/form-data" id="addMachine">
        {{csrf_field()}}
        <p class="text-primary"> You must enter the Customer Name ,Machine serial and Engineer Name </p>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="name">Customer Name</label>
                <input name="name" type="text" class="form-control" id="name" placeholder="Customer Name" required>
            </div>
            <div class="form-group col-md-4">
                <label for="machine_serial">Machine serial</label>
                <input name="machine_serial" type="number" class="form-control" id="machine_serial" placeholder="Machine serial" required >
            </div>

            <div class="form-group col-md-4">
              <label for="engineer_id">Engineer Name</label>
                <select  name="engineer_id" class="custom-select">
                  @foreach($eng as $engo)
                  <option value="{{$engo->id}}">{{$engo->name}}</option>
                  @endforeach
                  </select>
            </div>

            <div class="form-group col-md-6">
                <label for="address">address</label>
                <input name="address" type="text" class="form-control" id="address" placeholder="Address" >
            </div>

            <div class="form-group col-md-4">
                <label for="telephone">Telephone Number</label>
                <input name="telephone" type="number" class="form-control" id="telephone" placeholder="Telephone Number" >
            </div>
            <div class="form-group col-md-4">
                <label for="phone">Phone Number</label>
                <input name="phone" type="number" class="form-control" id="phone" placeholder="Phone Number" >
            </div>
            <div class="form-group col-md-4">
                <label for="contact_name">Contact Name</label>
                <input name="contact_name" type="text" class="form-control" id="contact_name" placeholder="Contact Name" >
            </div>
            <div class="form-group col-md-4">
                <label for="day_of_week">Days Off</label>
                <input name="day_of_week" type="text" class="form-control" id="day_of_week" placeholder="Inter the number of the days off" >
            </div>

        <div  class="form-group col-md-4 ">
            <label for="open_time">Start date</label>
            <input  type="time" name="open_time" class="form-control" id="open_time" placeholder="Enter the date" >
        </div>

            <div  class="form-group col-md-4 ">
                <label for="close_time">Close time</label>
                <input type="time" name="close_time" class="form-control" id="close_time" placeholder="Enter the date" >
            </div>

            <div class="form-group col-md-4">
                <label for="model_number">Model number</label>
                <input name="model_number" type="number" class="form-control" id="model_number" placeholder="Model number" >
            </div>


            <div class="form-group col-md-4">
                <label for="machine_place">Machine place</label>
                <input name="machine_place" type="text" class="form-control" id="machine_place" placeholder="Machine place" >
            </div>

            <div class="form-group col-md-4">
                 <label for="contract">Select Contract</label>
                    <select name="contract" class="form-control" >
                        <option value="EM">FSMA</option>
                        <option value="Quotation">Rental</option>
                        <option value="Installation">Labour</option>
                        <option value="Regular Visit">LIS</option>
                        <option value="Time and materials ">T&M </option>
                        <option value="To Complete">Warranty</option>
                        <option value="To Complete">In-house</option>
                    </select>
                </div>
            <div  class="form-group col-md-4 ">
                <label for="contract_start">Contract start</label>
                <input name="contract_start" type="date"  class="form-control" id="close_time" placeholder="Contract start"  >
            </div>

            <div  class="form-group col-md-4 ">
                <label for="billing_period">Billing period</label>
                <input name="billing_period" type="number"  class="form-control" id="billing_period" placeholder="Billing period" >
            </div>

            <div  class="form-group col-md-4 ">
                <label for="minimum_charge">Minimum charge</label>
                <input name="minimum_charge" type="number"  class="form-control" id="minimum_charge" placeholder="Minimum charge"  >
            </div>

            <div  class="form-group col-md-4 ">
                <label for="free_copies">Free copies</label>
                <input  name="free_copies" type="number" step="any" class="form-control" id="free_copies" placeholder="Free copies"  >
            </div>

            <div  class="form-group col-md-6">
                <label for="excess_copies">Excess copies</label>
                <input name="excess_copies" type="number" step="any" class="form-control" id="excess_copies" placeholder="Excess_copies" >
            </div>

            <div  class="form-group col-md-6">
                <label for="notes">Notes</label>
                <input name="notes" type="textarea"  class="form-control" id="notes" placeholder="Notes" >
            </div>
        <input type="submit" class="btn btn-primary" value="Submit"/>
        </div>
    </form>
</div>
@endsection
