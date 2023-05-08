@extends('layouts.main')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
@section('css')
@endsection
<div class="card-header mx-auto">
    Sales Invoice entry
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
    @if(session()->has('addedsale'))
        <div class="alert alert-success">{{session()->get('addedsale')}}</div>
    @endif
    @if(session()->has('enough'))
        <div class="alert alert-danger">{{session()->get('enough')}}</div>
    @endif

    <form action="{{route('sale.add.post')}}" method="post" enctype="multipart/form-data" id="prod">
        @csrf

        <div class="form-group">
            <label for="company">Company --- Default value = CopyCom </label>
            <select name="company" class="form-control">
                <option value="CopyCom">CopyCom</option>
                <option value="TrustTrade">TrustTrade</option>
            </select>
          </div>
        <div class="form-group">
            <label for="invoiceNumber">Invoice Number</label>
            <input name="invoice_number" type="text" class="form-control" id="invoice_number"
                   aria-describedby="emailHelp"
                   placeholder="Enter invoice number ">
              </div>

        <!---- table add product --->

            <div class="table-responsive">
                <table class="table  table-striped" id="dynamic">
                    <thead>
                    <tr>
                        <th scope="col">Part number</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Unit Price</th>
                        <th scope="col"><input type="button" class="btn btn-primary addRow" id="add" value="Add Product"/></th>

                    </tr>
                    </thead>
                    <br>
                    <br>
                    <tbody>
                    <tr class="tr">
                        <td class="eng">
                            <div class="form-group">
                                <select id="PartNumber" name="part_num[]" class="custom-select" required>
                                    @foreach($part_num as $part)
                                        <option value="{{$part->id}}">{{$part->part_num}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </td>

                        <td class="eng">
                            <div class="form-group">
                                <input name="quantity[]" type="number" class="form-control" id="quantity" placeholder="quantity" required>
                            </div>
                        </td>

                        <td class="eng">
                            <div class="form-group">
                                <input name="price[]" type="number" step="any" class="form-control" id="price" placeholder="Unit Price" required>
                            </div>
                        </td>

                        </td>
                        <td class="eng"><input type="button" class="btn btn-danger remove" id="add" value="Remove Product"/>
                        </td>

                    </tr>
                    </tbody>
                </table>
            </div>
            <!--- table end--->
            <br>
  <!---
            <div class="row">
            <div class="form-group">
                <label for="SalesMan">SalesMan</label>
            </div>
            <div class="col-2">
                <div class="form-check">
                    <input name="choose" onclick ="dis(0)"  class="form-check-input" type="radio" checked >
                </div>
            </div>
            <div class="form-group">
                <label for="engineer">engineer</label>
            </div>
            <div class="col">
                <div class="form-check">
                    <input name="choose" onclick ="dis(1)" class="form-check-input" type="radio">
                </div>
            </div>
                    </div> --->
            <div class="form-group" >
                <label for="sales_mens_id">Sales man</label>
                <select id="sal" class="custom-select" name="sales_mens_id">
                    @foreach($sales as $sale)
                        <option value="{{$sale->id}}">{{$sale->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group" >
                <label for="engineers_id">Engineer</label>
                <select id="eng" class="custom-select" name="engineers_id">
                    @foreach($eng as $engo)
                        <option value="{{$engo->id}}">{{$engo->name}}</option>
                    @endforeach
                </select>
            </div>

        <div class="form-group">
            <label for="customers_id">Customer Name</label>
            <select id="customers_id" class="custom-select" name="customers_id" required>
                @foreach($customer as $cust)
                    <option value="{{$cust->id}}">{{$cust->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="nameemployee">Name Employee</label>
            <input name="name_emp" type="text" class="form-control" id="name_emp" placeholder="Name Employee" required>
        </div>

        <br>

            <div class="row">
            <div class="form-group">
                <label for="tax">Tax</label>
            </div>
            <div class="col">
                <div class="form-check">
                    <input name="tax" class="form-check-input" type="checkbox" value="1" id="tax">
                </div>
            </div>
        </div>

        <br>
        <div class="form-group">
            <label for="checknumber">Check Number</label>
        </div>
        <div class="row">
            <div class="col-2">
                <div class="form-check">
                    <input name="check" class="form-check-input" type="checkbox" value="1" id="check">
                    <label class="form-check-label" for="check">
                        check
                    </label>
                </div>
            </div>
            <div class="col">
                <input name="check_num" type="text" class="form-control" id="checknumber" placeholder="check">
            </div>
        </div>

            <br>

            <div class="form-group">
            <label for="bydate">Date</label>
            <input name="date" class="form-control" type="date" id="bydate">
        </div>
        <input class="btn btn-primary" type="submit" value="Submit"/>
    </form>
    <br>
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
                ' <select id="PartNumber" name="part_num[]" class="custom-select" required>'+
                '@foreach($part_num as $part)'+
                '<option value="{{$part->id}}">{{$part->part_num}}</option>'+
                '@endforeach'+
                ' </select>'+
                ' </div>'+
                ' </td>'+

                '<td class="eng">'+
                '<div class="form-group">'+
                '<input name="quantity[]" type="number" class="form-control" id="quantity" placeholder="quantity" required>'+
                ' </div>'+
                ' </td>'+

                ' <td class="eng">'+
                ' <div class="form-group">'+
                '<input name="price[]" type="number" step="any" class="form-control"  id="price" placeholder="Unit Pricez" required>'+
                '</div>'+
                '</td>'+
                ' </td>'+
                ' <td class="eng"><input type="button" class="btn btn-danger remove" id="add" value="Remove Product"/>'+
                ' </td>'+
                ' </tr>';

            $('tbody').append(tr);
        };

        $('tbody').on('click','.remove' , function () {
            $(this).parent().parent().remove();
        });
$('#sal').prop('selectedIndex', -1)
$('#eng').prop('selectedIndex', -1)
    </script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
<script>
  $(document).ready(function() {
  $('.custom-select').select2();
});
</script>

@endsection

@endsection
