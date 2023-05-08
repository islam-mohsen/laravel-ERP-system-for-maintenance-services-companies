@extends('layouts.main')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
@section('css')
@endsection
<div class="card-header mx-auto">
    Edit Store Data
</div>
@section('some')
    <div id="productdata" class=" text-center"
         style="display: none; margin-top:7%;  width: 55%; margin-left: 9.1%; z-index: 100000; position: absolute;">
        <div class="card text-center ">
            <div class="card-header">
                Product Data
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="offset-sm-2 col-sm-8">
                        <label for="roomname">Room Name</label>
                        <input id="roomname" class="form-control" placeholder="search by P N">
                    </div>
                </div>
                <br>
                <br>
            </div>
            <div class="card-footer text-muted" style="color: white !important;">
                <a id="okbtn" class="btn btn-primary">OK</a>
                <a id="canceled" class="btn btn-primary">cancel</a>
            </div>
        </div>
    </div>
@endsection
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
    @if(session()->has('addedroom'))
        <div class="alert alert-success">{{session()->get('addedroom')}}</div>
    @endif
    @if(session()->has('deleteroom'))
        <div class="alert alert-success">{{session()->get('deleteroom')}}</div>
    @endif
    <form action="{{route('room.add.post',[$id])}}" method="post" enctype="multipart/form-data" id="prod">
        @csrf
        <div class="row">
            <div class="col-sm-6">
                <button id="addRoom" type="button" class=" btn btn-primary btn-larg"><i
                        class="fas fa-plus-square"></i> Add Room
                </button>
                <ul id="" class="list-group">
                </ul>
            </div>
        </div>
        <div class="form-group">
            <h5>Room :</h5>
            <ul id="roomlist" class="textclik list-group">
            </ul>
        </div>
        <input type="submit" class="endbut btn btn-primary" value="submit">
    </form>
    <br>
</div>
@section('content2')
    <div class="row" style="margin-top: 3%">
        <div class="col-sm-12">
            <table class="table table-dark">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Room Name</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
                </thead>
                <tbody id="tabelroom">
                <?php $i = 0; ?>
                @foreach($rooms as $room)
                    <?php $i++;?>
                    <tr>
                        <th scope='row'>
                        {{$i}}
                        </td>
                        <td>{{$room->name_room}}</td>
                        <td>
                            <a href='{{route('room.edit.get',[$room->id])}}'>
                                <button type='button' class='btn btn-primary'>Edit</button>
                            </a>
                        </td>
                        <td>
                            <a href='{{route('room.delete.get',[$room->id])}}'>
                                <button type='button' class='btn btn-danger'>Delete</button>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>

@endsection
@section('js')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function () {
            $("#okbtn").click(function (e) {
                e.preventDefault();
                var name = $("#roomname").val();
                if (name) {
                    $("#roomname").val('');
                    $("#productdata").hide();
                    $('#roomlist').append(
                        '<li datasend="' + name + '" class="prolis list-group-item list-group-item-secondary">' +
                        'Room Name :' + name + '<i  class=" closeli fas fa-times">' +
                        '<input type="hidden" name="room[]" value="' + name + '">' +
                        '</i></li>'
                    );
                }
            });
            $('#roomlist').on('click', 'li i', function () {
                $(this).parent().remove();
            });
            $('#addRoom').click(function () {
                $('#productdata').toggle();
            });
            $('#canceled').click(function () {
                $('#productdata').hide();
                $("#roomname").val(' ');
            });
            $('#PartNumber').keyup(function () {
                // $('#okbtn').click(function () {
                var dataString = 'prNum=' + $('#PartNumber').val();

                var PrNum = $('#PartNumber').val();
                var prdName = $('#pronamecon');
                var prdDec = $('#proDiscretioncon');
                var prdMod = $('#promodelcon');
                var prdType = $('#protypecon');
                var prdImg = $('#imagecard');
                var quantity = $('#quantity').val();
                // var quantity2 = quantity.val();
                $.ajax({
                    type: 'get',
                    url: '{{route("partNum")}}',
                    data: dataString,
                    // dataType: 'json',
                    success: function (data) {
                        // console.log(data)
                        prdImg.attr("src", "https://copycomegypt.com/copycomegypt/public/" + data.img)
                        prdName.text(data.brand_name_id);
                        prdDec.text(data.dec_id);
                        prdMod.text(data.prd_mod_id);
                        prdType.text(data.prd_type_id);
                        $('#okbtn').click(function () {
                            $('#productdata').hide();
                            $('#roductsadded').append(
                                '<h3><span class="badge badge-secondary">' + data.part_num + '</span>' +
                                ' <span class="badge badge-secondary">' + $('#quantity').val() + '</span></h3>' +
                                '<input type="hidden"  value="' + data.id + '" name="prd_id[]">' +
                                '<input type="hidden"  value="' + $('#quantity').val() + '" name="quantity[]">'
                            );
                            // quantity='';
                            $('#quantity').val('');
                            // data.part_num = '';
                            // console.log(data.part_num + 'gg');
                            $('#PartNumber').val('');
                            prdImg.attr("src", '');
                            prdName.text('');
                            prdDec.text('');
                            prdMod.text('');
                            prdType.text('');
                            // jQuery.each(data, function (i, val) {
                            //     // if (val.zipcode == "yourvalue") // delete index
                            //     // {
                            //     //     console.log(data['part_num']);
                            //     delete data['part_num'];
                            //     // console.log(data['part_num']);
                            //         // delete data[i][val];
                            //     // }
                            // });
                        });
                    }
                });
                // $('#quantity').val('');
            });


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
            $('#f').submit(function () {
                var tex = $('#tex');
                var dataString = 'text1=' + tex.val();
                $('#f').serialize();
                // $.get('ajax2', function (data) {
                //     // console.log(data);
                //     $('#re').append(data);
                //     // $('#re').append(tex.val());
                //     tex.val('');
                // });
                $.post('ajax2', dataString, function (data) {
                    $('#re').append(data.text1);
                    // console.log(data.text1);
                    tex.val('');
                });
                return false;
            });
        });
    </script>
@endsection

@endsection
