@extends('layouts.app2')
@section('content')
@section('css')
@endsection
    <div class="card-header mx-auto">
        Buy Product Data
    </div>
    <div class="card-body">
        <form>
            <div id="formdata" class="form-group">
                <label for="invoicenumber">Invoice Number</label>
                <input type="text" class="form-control" id="invoicenumber" aria-describedby="emailHelp"
                       placeholder="Enter invoice number ">

            </div>
            <div id="formdata" class="form-group">
                <label for="Productname">Product name</label>
                <select id="Productname" class="custom-select">
                    <option selected> select Product name</option>

                </select>

            </div>
            <div class="form-group">
                <label for="ProductDiscretion">Product Discretion</label>
                <select id="ProductDiscretion" class="custom-select">
                    <option selected> select Product Discretion</option>

                </select>
            </div>
            <div class="form-group">
                <label for="PartNumber">Part Number</label>
                <select id="PartNumber" class="custom-select">
                    <option selected> select Part Number</option>

                </select>
            </div>

            <div class="form-group">
                <label for="ProductModel">Product Model</label>
                <select id="ProductModel" class="custom-select">
                    <option selected> select Product Model</option>

                </select>
            </div>


            <div class="form-group">
                <label for="ProductType">Product Type</label>
                <select id="ProductType" class="custom-select">
                    <option selected> select Product Type</option>

                </select>
            </div>
            <div class="form-group">
                <label for="supplier">supplier</label>
                <select id="supplier" class="custom-select">
                    <option selected> select supplier</option>

                </select>
                <div class="form-group">
                    <label for="quantity">Quantity</label>
                    <input type="text" class="form-control" id="quantity" placeholder="quantity">
                </div>
                <div class="form-group">
                    <label for="nameemployee">Name Employee????</label>
                    <input type="text" class="form-control" id="nameemployee" placeholder="Name Employee">
                </div>
                <div class="form-group">
                    <label for="cost">cost</label>
                </div>


                <div class="row">
                    <div class="col">

                        <input type="text" class="form-control" id="price" placeholder="price">
                    </div>
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="tax">
                            <label class="form-check-label" for="tax">
                                Tax
                            </label>
                        </div>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label for="checknumber">Check Number</label>
                </div>
                <div class="row">
                    <div class="col">

                        <input type="text" class="form-control" id="checknumber" placeholder="price">
                    </div>
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="check">
                            <label class="form-check-label" for="check">
                                check
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="bydate">Date</label>
                    <input class="form-control" type="date" id="bydate">
                </div>
        </form>
        <br>
        <button onclick="savedata()" class="btn btn-primary">Submit</button>
    </div>
@section('js')
@endsection
@endsection
