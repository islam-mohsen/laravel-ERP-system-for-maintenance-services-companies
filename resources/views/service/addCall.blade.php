@extends('layouts.main')
@section('content')
    <div class="card-header mx-auto">
        <M>Add New Call</M>
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
        @if(session()->has('addedCall'))
            <div class="alert alert-success">{{session()->get('addedCall')}}</div>
        @endif
        <form action="{{route('addCall.store')}}" method="post" enctype="multipart/form-data" id="addCall">
            {{csrf_field()}}
            <div calss="form">
               <div class="form-group">
                <label for="machine_information_id">Select Machine with serial</label>
                <select name="machine_information_id" class="custom-select">
                  @foreach($machineInfos as $machineInfo)
                      <option value="{{$machineInfo->id}}" >{{$machineInfo->machine_serial}}&emsp;{{$machineInfo->name}}</option>
                  @endforeach
                </select>
               </div>
                <div class="form-group">
                    <label for="call_type">Call type</label>
                    <select name="call_type" class="form-control">
                        <option value="EM">EM</option>
                        <option value="Quotation">Quotation</option>
                        <option value="Installation">Installation</option>
                        <option value="Regular Visit">Regular Visit</option>
                        <option value="Time and materials ">Time and materials </option>
                         <option value="To Complete">To Complete</option>
                    </select>
                </div>
                <div class="form-group ">
                    <label for="problem">Problem</label>
                    <input name="problem" type="textarea" class="form-control" id="machine_place" placeholder="Problem">
                </div>
                <input type="submit" class="btn btn-primary" value="Submit"/>
            </div>
        </form>
    </div>
@endsection
@section('js')
  <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
<script>
  $(document).ready(function() {
  $('.custom-select').select2();
});
</script>
@endsection
