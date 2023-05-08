@extends('layouts.main')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
@section('css')
@endsection
<div class="card-header mx-auto">
    Buy Product Data
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
    @if(session()->has('addedBuy'))
        <div class="alert alert-success">{{session()->get('addedBuy')}}</div>
    @endif
    <form action="{{route('buy.add.post')}}" method="post" enctype="multipart/form-data" id="prod">
        {{csrf_field()}}
        <div id="formdata" class="form-group">
            <label for="invoicenumber">Invoice Number</label>
            <input name="invoice" type="text" class="form-control" id="invoicenumber" aria-describedby="emailHelp"
                   placeholder="Enter invoice number" required>
        </div>
        <!---- table add product --->
        <div class="table-responsive">
            <table class="table  table-striped" id="dynamic">
                <thead>
                <tr>
                    <th scope="col">Part number</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">price</th>
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
                                <input name="price[]" type="number" step="any" class="form-control" id="price" placeholder="price" required>
                            </div>
                        </td>
                        <td class="eng"><input type="button" class="btn btn-danger remove" id="add" value="Remove Product"/>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!--- table end--->
        <div class="form-group">
            <label for="supplier">supplier</label>
            <select id="supplier" class="custom-select" name="supplier" required>
                @foreach($supplier as $supplier)
                    <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                @endforeach
            </select>
        </div>
            <div class="form-group">
                <label for="nameemployee">Name Employee</label>
                <input name="emp_name" type="text" class="form-control" id="nameemployee" placeholder="Name Employee" required>
            </div>
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
                        <input name="check1" class="form-check-input" type="checkbox" value="1" id="check">
                        <label class="form-check-label" for="check">
                            check
                        </label>
                    </div>
                </div>
                <div class="col">
                    <input name="check_num" type="text" class="form-control" id="checknumber" placeholder="Check Number">
                </div>
            </div>
            <div class="form-group">
                <label for="bydate">Date</label>
                <input name="date" class="form-control" type="date" id="bydate" required>
            </div>
            <input type="submit" class="btn btn-primary" value="Submit"/>
    </form>
</div>
@section('js')
    <script>
  //      $.ajaxSetup({
    //        headers: {
    //            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //        }
    //    });

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
                ' <select id="PartNumber" name="part_num[]" class="custom-select" required >'+
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
                '<input name="price[]" type="number" step="any" class="form-control" id="price" placeholder="price" required>'+
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


    //    $(document).ready(function () {
            // $('#f').submit(function () {
            //     var tex = $('#tex').val();
            //     // var token = $("input[name:_token]");
            //     // console.log(tex);
            //     // return false;
            //     $.post('ajax2', function (data) {
            //         // console.log(token);
            //         $('#re').append(data);
            //         //     $('#re').append(tex);
            //         //     tex.val('');
            //     });
            // });
      //      $('#f').submit(function () {
      //          var tex = $('#tex');
      //          var dataString = 'text1=' + tex.val();
      //          $('#f').serialize();
                // $.get('ajax2', function (data) {
                //     // console.log(data);
                //     $('#re').append(data);
                //     // $('#re').append(tex.val());
                //     tex.val('');
                // });
      //          $.post('ajax2', dataString, function (data) {
      //              $('#re').append(data.text1);
                    // console.log(data.text1);
      //              tex.val('');
     //           });
                // $.ajax({
                //     type: 'POST',
                //     url: 'ajax2',
                //     data: dataString,
                //     success: function (data) {
                //         $('#re').append(data.text1);
                //         console.log(data.text1);
                //         tex.val('');
                //     }
                // });
      //          return false;
     //       });
     //   });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
    $('.custom-select').select2();
});
</script>
@endsection
@endsection
