@extends('layouts.stdash')
@section('content')
@section('css')
@endsection
<div style="margin-top: 30px" id="Pur chases" class="tabels col-sm-12">

    <div class="card text-center ">
        <div class="card-header">
            Store
        </div>
        <div class="card-body">
            <label for="">Date</label>
            <input class="form-control" type="date" id="date">
            <div class="table-responsive">
                <table class=" table-striped table-dark">
                    <br>
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Com</th>
                        <th scope="col">Part Number</th>
                        <th scope="col">Discreption</th>
                        <th scope="col">Prand Name</th>
                        <th scope="col">Model Number</th>
                        <th scope="col">Supplier</th>
                        <th scope="col">Product type</th>

                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">filter</th>
                        <td><input class="form-control" id="com" placeholder="Enter com Name" type="text"></td>
                        <td><input class="form-control" id="part" placeholder="Enter p n" type="text"></td>
                        <td><input class="form-control" id="dec" placeholder="Enter Discreption" type="text">
                        </td>
                        <td><input class="form-control" id="brand" placeholder="Enter Prand Name" type="text"></td>
                        <td><input class="form-control" id="model" placeholder="Enter Model Number" type="text">
                        </td>
                        <td><input class="form-control" id="supp" placeholder="Enter Supplier Name" type="text">
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
                        <th scope="col">Employ</th>
                        <th scope="col">Supplier</th>
                        <th scope="col">invoice</th>
                        <th scope="col">Check</th>
                        <th scope="col">Part Number</th>
                        <th scope="col">Part Number HP</th>
                        <th scope="col">Discreption</th>
                        <th scope="col">Prand Name</th>
                        <th scope="col">Model Number</th>
                        <th scope="col">quantity</th>
                        <th scope="col">Unit Price</th>
                        <th scope="col">Total Price</th>
                        <th scope="col">Unit Price With Tax</th>
                        <th scope="col">Total Tax</th>
                        <th scope="col">Product type</th>
                    </tr>
                    </thead>
                    <br>
                    <br>
                    <tbody id="myTable">
                    <?php $i = 0;?>
                    @foreach($buys as $buy)
                        <?php $i++;?>
                        <tr class="tr">
                            <th scope="row">{{$buy->id}}</th>
                            <td class="date">{{$buy->buy_product->date}}</td>
                            <td class="com">{{$buy->name_emp}}</td>
                            <td class="supp">{{$buy->buy_product->supplier->name}}</td>
                            <td>{{$buy->buy_product->invoice_number}}</td>
                            <td>{{$buy->buy_product->check_num}}</td>
                            <td class="part">{{$buy->product->part_num}}</td>
                            <td class="part">{{$buy->product->part_num_hp==null?'___':$buy->product->part_num_hp}}</td>
                            <td class="dec">{{$buy->product->dec->dec}}</td>
                            <td class="brand">{{$buy->product->brand->name}}</td>
                            <td class="model">{{$buy->product->prdMod->prd_mod}}</td>
                            <td>{{$buy->quantity}}</td>
                            <td>{{$buy->cost}}</td>
                            <td>{{$buy->cost * $buy->quantity}}</td>
                            <td>{{$buy->cost * app('tax')}}</td>
                            <td>{{($buy->cost * $buy->quantity)*app('tax')}}</td>

                            <td class="type">{{$buy->product->type->prd_type}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer text-muted text-center">
            {!! $buys->render()!!}
        </div>
    </div>
</div>


@section('js')
    <script src="js/storedashbord.js"></script>
    <script>
        $('#supp').keyup(function () {
            var value = $(this).val().toLowerCase();
            $('#myTable .tr .supp').filter(function () {
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
        $('#com').keyup(function () {
            var value = $(this).val().toLowerCase();
            $('#myTable .tr .com').filter(function () {
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
