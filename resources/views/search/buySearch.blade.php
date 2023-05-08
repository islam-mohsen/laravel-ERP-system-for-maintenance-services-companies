@extends('layouts.stdash')
@section('content')
@section('css')
@endsection
<div style="margin-top: 30px" id="sto re" class="tabels col-sm-12">

    <div class="card text-center ">
        <div class="card-header">
            Store
        </div>
        <div class="card-body">
            <table class=" table-striped table-dark">
                <thead>
                <tr>

                    <th scope="col">Part Number</th>
                    <th scope="col">Discreption</th>
                    <!--<th scope="col">Prand Name</th>-->
                    <th scope="col">Model Number</th>
                    <th scope="col">Location</th>
                    <th scope="col">Product type</th>
                    <th scope="col">#</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <form action="{{route('Store.search')}}" method="post">
                        {{ csrf_field() }}
                        <td><input name="Search_Part_number" class="form-control" id="brand" placeholder="Enter Part Number" type="text"></td>
                        <td><input name="Search_Description" class="form-control" id="dec" placeholder="Enter Description" type="text"></td>
                        <td><input name="search_Model_Number" class="form-control" id="model" placeholder="Enter Model Number" type="text"></td>
                        <td><input name="Store_Store_Location" class="form-control" id="loca" placeholder="Enter Store Location" type="text"></td>
                        <td><input name="search_product_Type" class="form-control" id="type" placeholder="Enter product type" type="text"></td>
                        <td><input name="searchSubmit" class="btn btn-primary" type="submit"  value='Search'/></td>
                    </form>
                </tr>
                </tbody>
            </table>
            <table class="table  table-striped table-dark">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Part Number</th>
                    <th scope="col">Part Number HP</th>
                    <th scope="col">Discreption</th>
                    <th scope="col">Prand Name</th>
                    <th scope="col">Model Number</th>
                    <th scope="col">quantity</th>
                    <th scope="col">Unit Price</th>
                    <th scope="col">Unit Price Tax</th>
                    <th scope="col">Total Price With Tax</th>
                    <th scope="col">Location</th>
                    <th scope="col">Product type</th>
                </tr>
                </thead>
                <br>
                <br>
                <tbody id="myTable">
                <?php $i = 0;?>
                @foreach($stores as $store)
                    <?php $i++;
                    ?>
                    <th scope="row">{{$i}}</th>
                    <td class="part">{{$store->part_num}}</td>
                    <td class="part">{{$store->part_num_hp==null?'___':$store->part_num_hp}}</td>
                    <td class="dec">{{$store->dec->dec}}</td>
                    <td class="brand">{{$store->brand->name}}</td>
                    <td class="model">{{$store->prdMod->prd_mod}}</td>
                    <td>{{$store->cost}}</td>
                    <td>{{$store->cost * app('tax')}}</td>
                    <td>{{$store->cost * app('tax')+$store->cost}} </td>
                    <td>{{$store->room_of_prds->quantity}} </td>
                    <td class="type">{{$store->type['prd_type']}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
        <div class="card-footer text-muted text-center">

        </div>
    </div>
</div>


@section('js')


@endsection
@endsection
