@extends('layouts.main')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
@section('css')
@endsection
<div class="card-header mx-auto">
    Add Product to Engineer
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
    @if(session()->has('addedEngineerStock'))
        <div class="alert alert-success">{{session()->get('addedEngineerStock')}}</div>
    @endif
<form action="{{route('storeEngineersStock',$eng->id)}}" method="post" enctype="multipart/form-data" id="prod">
        {{csrf_field()}}

        <!---- table add product --->
<div class="table-responsive">
  <table class="table  table-striped" id="dynamic">
    <thead>
        <tr>
              <th scope="col">Part number</th>
                    <th scope="col">Quantity</th>
                    <th scope="col"><input type="button" class="btn btn-primary addRow" id="add" value="Add Product"/></th>

                </tr>
                </thead>
                <br>
                <br>
                <tbody>
                   <tr class="tr">
                        <td class="eng">
                            <div class="form-group">
                                <select id="PartNumber" name="product_id[]" class="custom-select" >
                                    @foreach($prd as $part)
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
    </form>
</div>
@section('js')
    <script>
        $('.addRow').on('click', function () {
            addRow();
            $(document).ready(function() {
            $('.custom-select').select2();
        });
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

                $('tbody').append(tr);
        };

        $('tbody').on('click','.remove' , function () {
      $(this).parent().parent().remove();
        });
    </script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
    <script>
      $(document).ready(function() {
      $('.custom-select').select2();
    });
    </script>
@endsection
@endsection
