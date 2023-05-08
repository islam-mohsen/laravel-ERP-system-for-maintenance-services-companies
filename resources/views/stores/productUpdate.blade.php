@extends('layouts.main')
@section('content')
@section('css')
@endsection
<div class="card-header mx-auto">
    Product Data
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
    @if(session()->has('updateProduct'))
        <div class="alert alert-success">{{session()->get('updateProduct')}}</div>
    @endif
    <form action="{{route('updateProduct',$product->id)}}" method="post" enctype="multipart/form-data" id="prod">
      @csrf
        @method('PUT')

        <div class="form-group">
            <label for="PartNumber">Part Number</label>
            <input name="part_num" type="text" class="form-control" id="PartNumber" placeholder="Part Number" value="{{$product->part_num}}">
        </div>
        <div class="form-group">
            <label for="PartNumber">Part Number HP</label>
            <input name="part_num_hp" type="text" class="form-control" id="PartNumber" placeholder="Part Number" value="{{$product->part_num_hp}}">
        </div>

        <div class="form-group">
            <label for="prd_mod">Product Model</label>
            <select name="prd_mod" id="PartNumber" class="custom-select">
                <option selected> select Product Model</option>
                @foreach($model as $modelo)
                    <option value="{{$modelo->id}}">{{$modelo->prd_mod}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="brand">Brand Name</label>
            <select name="brand" id="PartNumber" class="custom-select">
                <option selected> select Brand Name</option>
                @foreach($brands as $brand)
                    <option value="{{$brand->id}}">{{$brand->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="PartNumber">Product Description</label>
            <select name="dec" id="PartNumber" class="custom-select">
                <option selected> select Product Description</option>
                @foreach($decs as $dec)
                    <option value="{{$dec->id}}">{{$dec->dec}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="prd_type">Product Type</label>
            <select name="prd_type" id="ProductType" class="custom-select">
                <option selected>Select Product Type</option>
                @foreach($type as $typeo)
                    <option value="{{$typeo->id}}">{{$typeo->prd_type}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="cost">Cost</label>
            <input name="cost" type="number"  step="any" class="form-control" id="cost" placeholder="Cost" value="{{$product->cost}}">
        </div>
        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input name="quantity" type="number" class="form-control" id="quantity" placeholder="quantity" value="{{$quantity->quantity}}">
        </div>

        <div class="form-group">
            <label for="stockl">Minimum stock level</label>
            <input name="min" type="number" class="form-control" id="stockl" placeholder="Minimum stock level" value="{{$product->min}}">
        </div>

        <div class="form-group">
            <label for="room_id">Room</label>
            <select name="room_id"  class="custom-select">
                @foreach($room as $roomo)
                    <option value="{{$roomo->id}}" {{ $quantity->room->id == $roomo->id ? 'selected="selected"' : '' }}>
                      {{$roomo->name_room}}</option>
                @endforeach
            </select>
        </div>

        <input type="submit" name="productadd" class="btn btn-primary" value='Submit'/>
    </form>
</div>
@section('js')
@endsection

@endsection
