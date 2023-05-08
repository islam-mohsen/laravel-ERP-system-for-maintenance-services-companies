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
    @if(session()->has('addedproduct'))
        <div class="alert alert-success">{{session()->get('addedproduct')}}</div>
    @endif
    <form action="{{route('product.add')}}" method="post" enctype="multipart/form-data" id="prod">
        {{csrf_field()}}
        <div calss="form">
        <div class="form-group">
            <label for="PartNumber">Brand Name</label>
            <select name="brand" id="PartNumber" class="custom-select" required>
                <option selected> select Brand Name</option>
                @foreach($brands as $brand)
                    <option value="{{$brand->id}}" namebrand="{{$brand->name}}">{{$brand->name}}</option>
                @endforeach
            </select>
        </div>

        {{--<div id="formdata" class="form-group">--}}
        {{--<label for="exampleInputEmail1">Brand Name</label>--}}
        {{--<input type="search" class="form-control" id="brandname" aria-describedby="emailHelp"--}}
        {{--placeholder="Enter the name ">--}}
        {{--<div id="brandlist">--}}
        {{--</div>--}}
        {{--<ul id="result" class="list-group">--}}
        {{--</ul>--}}
        {{--</div>--}}

        <div class="form-group">
            <label for="PartNumber">Product Description</label>
            <select name="dec" id="PartNumber" class="select custom-select" required>
                <option selected> select Product Description</option>
                @foreach($decs as $dec)
                    <option value="{{$dec->id}}">{{$dec->dec}}</option>
                @endforeach
            </select>
        </div>
        {{--<div class="form-group">--}}
        {{--<label for="ProductDiscretion">Product Discretion</label>--}}
        {{--<input type="search" class="form-control" id="ProductDiscretion" placeholder="Product Discretion">--}}
        {{--<ul id="resultdis" class="list-group">--}}
        {{--</ul>--}}
        {{--</div>--}}
        <div class="form-group">
            <label for="PartNumber">Part Number</label>
            <input name="part_num" type="text" class="form-control"  placeholder="Part Number" required>
        </div>
        <div class="form-group">
            <label for="PartNumber">Part Number HP</label>
            <input name="part_num_hp" type="text" class="form-control"  placeholder="Part Number" required>
        </div>

        <div class="form-group">
            <label for="ProductModel">Product Model</label>
            <input name="prd_mod" type="text" class="form-control" id="ProductModel" placeholder="Product Mode" required>
        </div>

        <div class="form-group">
            <label for="PartNumber">Product Type</label>
            <select name="prd_type" id="ProductType" class="custom-select" placeholder="Minimum stock level" required>
              <option value="">None</option>
                @foreach($type as $brand)
                    <option value="{{$brand->id}}">{{$brand->prd_type}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="cost">Cost</label>
            <input name="cost" type="number" class="form-control" id="cost" placeholder="Cost" required>
        </div>

        <div class="form-group">
            <label for="stockl">Minimum stock level</label>
            <input name="min" type="number" class="form-control" id="stockl" placeholder="Minimum stock level" required>
        </div>

        <div class="form-group">
            <label for="PartNumber">On Room Name</label>
            <select name="room" id="PartNumber" class="custom-select" required>
              <option value="">None</option>
                @foreach($room as $brand)
                    <option value="{{$brand->id}}">{{$brand->name_room}}</option>
                @endforeach
            </select>
        </div>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroupFileAddon01">Product Image</span>
            </div>
            <div class="custom-file">
                <input name="img" type="file" class="custom-file-input" id="inputGroupFile01"
                       aria-describedby="inputGroupFileAddon01">
                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
            </div>
        </div>
        <input type="submit" name="productadd" class="btn btn-primary" value='Submit'/>
      </div>
    </form>
</div>
@section('js')
    <script>
        $(document).ready(function () {
            $('#PartNumber').change(function () {
                if ($('option:selected', this).attr('namebrand').toLowerCase() == 'hp') {
                    $('#part_hp').html(
                        '<label for="PartNumber">Part Number For HP</label>' +
                        '<input name="part_num_hp" type="text" class="form-control" id="part_hp" placeholder="P N For HP">'
                    );
                } else {
                    $('#part_hp').text(' ');
                }
            });
        });
        {{--$(document).ready(function () {--}}
        {{--$("#brandname").keyup(function () {--}}
        {{--var form = $('#prod').serialize();--}}
        {{--alert(form);--}}
        {{--return false;--}}
        {{--var query = $(this).val();--}}
        {{--if (query != '') {--}}
        {{--var _token = $('input[name="_token"]').val();--}}
        {{--$.ajax({--}}
        {{--// console.log(_token,query);--}}
        {{--url: "{{ route('autoCompleteBrand') }}",--}}
        {{--method: "POST",--}}
        {{--data: {query: query, _token: _token},--}}
        {{--success: function (data) {--}}
        {{--$('#brandlist').fadeIn();--}}
        {{--$('#brandlist').html(data);--}}
        {{--console.log(data);--}}
        {{--}--}}
        {{--});--}}
        {{--}--}}
        {{--});--}}

        {{--$(document).on('click', 'li', function () {--}}
        {{--$('#brandname').val($(this).text());--}}
        {{--$('#brandlist').fadeOut();--}}
        {{--});--}}
        {{--});--}}
    </script>
      <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
    <script>
      $(document).ready(function() {
      $('.select').select2();
    });
    </script>
@endsection

@endsection
