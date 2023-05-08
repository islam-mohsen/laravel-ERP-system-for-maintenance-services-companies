@extends('layouts.main')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
@section('css')
@endsection
<div class="card-header mx-auto">
    Supplier Data
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
    @if(session()->has('addedsupplier'))
        <div class="alert alert-success">{{session()->get('addedsupplier')}}</div>
    @endif
    <form action="{{route('supplier.add.post')}}" method="post" enctype="multipart/form-data" id="prod">
        {{csrf_field()}}
        <div class="form-group">
            <label for="Suppliername">Supplier name</label>
            <input name="name" type="text" class="form-control" placeholder="Enter the name ">
        </div>
        <div  class="form-group">
            <label for="number">Number</label>
            <input name="number" type="text" class="form-control" placeholder="Enter the Number ">
        </div>

        <div class="form-group">
            <label for="address">address</label>
            <input name="address" type="text" class="form-control" id="address" placeholder="Address ">
        </div>
        <div class="form-group">
            <label for="Mobilenumber">Mobile Number</label>
            <input name="phone" type="text" class="form-control" id="Mobilenumber" placeholder="Mobile">
        </div>

        <div class="form-group">
            <label for="Telephonenumber">Telephone Number</label>
            <input name="telephone" type="text" class="form-control" id="Telephonenumber" placeholder="Telephone">
        </div>
        <input type="submit" class="btn btn-primary" value="Submit"/>
    </form>
</div>

@section('js')
    <script>
    //    $.ajaxSetup({
    //        headers: {
    //            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //        }
  //      });

  //      $(document).ready(function () {
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
    //        $('#f').submit(function () {
  //              var tex = $('#tex');
    //            var dataString = 'text1=' + tex.val();
    //            $('#f').serialize();
                // $.get('ajax2', function (data) {
                //     // console.log(data);
                //     $('#re').append(data);
                //     // $('#re').append(tex.val());
                //     tex.val('');
                // });
      //          $.post('ajax2', dataString, function (data) {
    //                $('#re').append(data.text1);
                    // console.log(data.text1);
      //              tex.val('');
      //          });
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
        //        return false;
        //    });
    //    });
    </script>
@endsection
@endsection
