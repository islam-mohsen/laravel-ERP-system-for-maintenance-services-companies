@extends('layouts.stdash')
@section('content')
@section('css')
@endsection
<div style="margin-top: 30px" id="seals e" class="tabels col-sm-12">
    <div class="card text-center ">
        <div class="card-header">
            Store
        </div>
        <div class="card-body">
            <label for="">Date</label>
            <input class="form-control" type="date" id="date">
            <div class="table-responsive">
                <table class=" table-striped table-dark">
                    br
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">eng</th>
                        <th scope="col">Part Number</th>
                        <th scope="col">Discreption</th>
                        <th scope="col">Prand Name</th>
                        <th scope="col">Model Number</th>
                        <th scope="col">Customer</th>
                        <th scope="col">Product type</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">filter</th>
                        <td><input class="form-control" id="eng" placeholder="Enter eng Name" type="text"></td>
                        <td><input class="form-control" id="part" placeholder="Enter p n" type="text"></td>
                        <td><input class="form-control" id="dec" placeholder="Enter Discreption" type="text">
                        </td>
                        <td><input class="form-control" id="brand" placeholder="Enter Prand Name" type="text"></td>
                        <td><input class="form-control" id="model" placeholder="Enter Model Number" type="text">
                        </td>
                        <td><input class="form-control" id="customer" placeholder="Enter Customer Name" type="text">
                        </td>
                        <td><input class="form-control" id="type" placeholder="Enter product type" type="text">
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="table-responsive">
                <table class="table  table-striped table-dark">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Date</th>
                        <th scope="col">eng</th>
                        <th scope="col">Customer</th>
                        <th scope="col">invoice</th>
                        <th scope="col">Part Number</th>
                        <th scope="col">Part Number HP</th>
                        <th scope="col">Discreption</th>
                        <th scope="col">Prand Name</th>
                        <th scope="col">Model Number</th>
                        <th scope="col">quantity</th>
                        <th scope="col">Unit Price</th>
                        <th scope="col">Total Price</th>
                        <th scope="col">Unit Price With Tax</th>
                        <th scope="col">Total Price With Tax</th>

                        <th scope="col">Product type</th>

                    </tr>
                    </thead>
                    <br>
                    <br>
                    <tbody id="myTable">
                    <?php $i = 0;?>
                    @foreach($sales as $sale)
                        <?php $i++; ?>
                        <tr class="tr">
                            <th scope="row">{{$i}}</th>
                            <td class="date">{{$sale->sale->date}}</td>
                            <td class="eng">{{$sale->sale->eng_sale}}</td>
                            <td class="customer">{{$sale->sale->name_emp}}</td>
                            <td>{{$sale->sale->invoice_number}}</td>
                            <td class="part">{{$sale->prds->part_num}}</td>
                            <td class="part">{{$sale->prds->part_num_hp}}</td>
                            <td class="dec">{{$sale->prds->dec->dec}}</td>
                            <td class="brand">{{$sale->prds->brand->name}}</td>
                            <td class="model">{{$sale->prds->prdMod->prd_mod}}</td>
                            {{--                            <td>{{$sale->sale}}</td>--}}
                            {{--                            <td>{{$sale}}</td>--}}
                            <td>{{$sale->quantity}}</td>
                            <td>{{$sale->cost}}</td>
                            <td>{{$sale->quantity * $sale->cost}}</td>
                            <td>
                               {{$sale->cost * app('tax')}}
                            </td>
                            <td>
                               {{($sale->quantity * $sale->cost)+$sale->cost * app('tax')}}
                               
                            </td>
                            <td class="type">{{$sale->prds->type->prd_type}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer text-muted text-center">
            {!! $sales->render()!!}
        </div>
    </div>
</div>
@section('js')
    <script src="js/storedashbord.js"></script>
    <script>
        $('#eng').keyup(function () {
            var value = $(this).val().toLowerCase();
            $('#myTable .tr .eng').filter(function () {
                $(this).parent().toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        $('#part').keyup(function () {
            var value = $(this).val().toLowerCase();
            $('#myTable .tr .part').filter(function () {
                $(this).parent().toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        $('#dec').keyup(function () {
            var value = $(this).val().toLowerCase();
            $('#myTable .tr .dec').filter(function () {
                $(this).parent().toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        $('#model').keyup(function () {
            var value = $(this).val().toLowerCase();
            $('#myTable .tr .model').filter(function () {
                $(this).parent().toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        $('#type').keyup(function () {
            var value = $(this).val().toLowerCase();
            $('#myTable .tr .type').filter(function () {
                $(this).parent().toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        $('#brand').keyup(function () {
            var value = $(this).val().toLowerCase();
            $('#myTable .tr .brand').filter(function () {
                $(this).parent().toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        $('#customer').keyup(function () {
            var value = $(this).val().toLowerCase();
            $('#myTable .tr .customer').filter(function () {
                $(this).parent().toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        $('#date').change(function () {
            console.log($('#date').val())
            var value = $(this).val().toLowerCase();
            $('#myTable .tr .date').filter(function () {
                $(this).parent().toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    </script>
@endsection
@endsection
