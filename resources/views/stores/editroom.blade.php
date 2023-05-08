@extends('layouts.main')
@section('content')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <style>
        #myUL {
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: none;
        }

        #myUL li a {
            border: 1px solid #ddd;
            margin-top: -1px; /* Prevent double borders */
            background-color: #f6f6f6;
            padding: 12px;
            text-decoration: none;
            font-size: 18px;
            color: black;
            display: block
        }

        #myUL li a:hover:not(.header) {
            background-color: #eee;
        }
    </style>
@endsection
<div class="card-header mx-auto">
    Sale Product Data
</div>
@section('some')
    <div id="productdata" class=" text-center"
         style="display: none; margin-top:10%;  width: 55%; margin-left: 9.1%; z-index: 100000; position: absolute;">
        <div class="card text-center ">
            <div class="card-header">
                Product Data
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="offset-sm-2 col-sm-8">
                        <span id="prdid" style="display: none"></span>
                        <span id="prdImg" style="display: none"></span>
                        <span id="prdName" style="display: none"></span>
                        <span id="prdDec" style="display: none"></span>
                        <span id="prdMod" style="display: none"></span>
                        <span id="prdType" style="display: none"></span>
                        <label for="PartNumber">Part Number</label>
                        <input id="PartNumber" class="form-control" placeholder="search by P N">
                        <ul id="partnumertarget" class="list-group dropdown"
                            style="display: none; z-index: 5000;;height: 150px; overflow: auto;position: absolute;width: 95%;">
                        </ul>
                        <ul id="myUL">
                        </ul>
                        <br>
                        <br>
                    </div>
{{--                    <div class="col-sm-4">--}}
{{--                        <h5 class="inlin">product name :</h5><span id="pronamecon"></span>--}}
{{--                    </div>--}}
                    <div class="col-sm-4">
                        <h5 class="inlin">product Discretion :</h5><span id="proDiscretioncon"></span>
                        <span id="prddid"></span>
                    </div>
                    <div class="col-sm-4">
                        <h5 class="inlin">product Model :</h5><span id="promodelcon"></span>
                    </div>
                    <br>
                    <div class="col-sm-4">
                        <h5 class="inlin">product Type :</h5><span id="protypecon"></span>
                    </div>
                    <br>
                    <div class="col-sm-12" style="margin-top: 2%">
                        <img height="300" id="imagecard" src="" alt="..." class="img-thumbnail">
                    </div>
                    <div class="offset-sm-2 col-sm-8">
                        <label for="quantity">Quantity</label>
                        <input type="text" class="form-control" id="quantity" placeholder="quantity">
                    </div>
                </div>

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
    @if(session()->has('editedquantity'))
        <div class="alert alert-success">{{session()->get('editedquantity')}}</div>
        {{session()->forget('editedquantity')}}
        {{session()->forget('idpage')}}
    @endif
    @if(session()->has('addedProduct1'))
        <div class="alert alert-success">{{session()->get('addedProduct1')}}</div>
    @endif
    @if(session()->has('deleteroomof'))
        <div class="alert alert-success">{{session()->get('deleteroomof')}}</div>
    @endif
    <form action="{{route('room.edit.post',[$id])}}" method="post" enctype="multipart/form-data" id="prod">
        @csrf
        <div class="row">
            <div class="col-sm-6">
                <button id="addprod" type="button" class=" btn btn-primary btn-larg"><i
                        class="fas fa-plus-square"></i> Add Proudct
                </button>
                <ul id="prodlist" class="list-group">
                </ul>
            </div>
        </div>
        <div class="form-group">
            <h5>Prouducts :</h5>
            <div id="roductsadded"></div>
        </div>
        <br>
        <br>
        <input class="btn btn-primary" type="submit" value="Submit"/>
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
                    <th scope="col">Product Number</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
                </thead>
                {{session()->put('idpage', $id)}}
                <tbody id="tabelroom">
                <?php $i = 0; ?>
                @foreach($roomof as $room)
                    <?php $i++;?>
                    <tr>
                        <th scope='row'>
                        {{$i}}
                        </td>
                        <td>{{$room->prds->part_num}}</td>
                        <td>{{$room->quantity}}</td>
                        <td>
                            <a class="cl" href='{{route('quantity.edit.get',[$room->id])}}'>
                                <button type='button' class='btn btn-primary'>Edit</button>
                            </a>
                        </td>
                        <td>
                            <a href='{{route('roomofprd.delete.get',[$room->id])}}'>
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
            $('#addprod').click(function () {
                $('#productdata').show();
                $('#partnumertarget').text('');
                data = '';
                $('#partnumertarget').html('');
                $.ajax({
                    type: 'get',
                    url: '{{route("allprd")}}',
                    success: function (data) {
                        // console.log(data)
                        for (var i = 0; i < data.length; i++) {
                            $('#partnumertarget').append(
                                '<li ' +
                                ' prdid="' + data[i].id + '"' +
                                ' prdImg="' + data[i].img + '"' +
                                ' partNum="' + data[i].part_num + '"' +
                                ' prdName="' + data[i].brand_name_id + '"' +
                                ' prdDec="' + data[i].dec_id + '"' +
                                ' prdMod="' + data[i].prd_mod_id + '"' +
                                ' prdType="' + data[i].prd_type_id + '"' +
                                ' idindex="' + i + '" ' +
                                'class="list-group-item link-class">' + data[i].part_num + '</li>'
                            );
                        }
                        $('#PartNumber').keyup(function () {
                            var value = $(this).val().toLowerCase();
                            $('#partnumertarget li').filter(function () {
                                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                            });
                            $('#partnumertarget').show();
                        });
                        $('#partnumertarget').on('click', 'li', function () {
                            var prNum = $(this).attr('partNum');
                            var dataString = 'prNum=' + prNum;
                            $.ajax({
                                type: 'get',
                                url: '{{route("partNum")}}',
                                data: dataString,
                                success: function (data) {
                                    // console.log(data)
                                    // console.log(data.dec.dec)
                                    var prdDec = $('#proDiscretioncon');//
                                    var prddid = $('#prddid');//
                                    var prdMod = $('#promodelcon');//
                                    var prdType = $('#protypecon');//
                                    var prdImg = $('#imagecard');//
                                    $('#partnumertarget').hide();
                                    $('#PartNumber').val(data.part_num);
                                    prdImg.attr("src", "https://copycomegypt.com/copycomegypt/public/" + data.img);
                                    prdDec.text(data.dec.dec);
                                    prddid.val(data.id);
                                    prdMod.text(data.prd_mod.prd_mod);
                                    prdType.text(data.type.prd_type);
                                }
                            });
                        });
                    }
                });
            });
            $('#okbtn').click(function () {
                $('#productdata').hide();
                $('#roductsadded').append(
                    '<li datasend="' + $('#PartNumber').val() + '" class="prolis list-group-item list-group-item-secondary">' +
                    'Product Number : ' + $('#PartNumber').val() + ' - Quantity : ' + $('#quantity').val() + '<i  class=" closeli fas fa-times">' +
                    '<input type="hidden"  value="' + $('#prddid').val() + '" name="prd_id[]">' +
                    '<input type="hidden"  value="' + $('#quantity').val() + '" name="quantity[]">' +
                    '</i>' +
                    '</li>'
                );
                $('#partnumertarget').text('');
                data = '';
                $('#partnumertarget').html('');
                $('#PartNumber').val('');
                $('#quantity').val('');

                $('#protypecon').text('');
                $('#pronamecon').text('');
                $('#PartNumber').text('');
                $('#proDiscretioncon').text('');
                $('#promodelcon').text('');
                $('#protypecon').text('');
                $('#imagecard').attr("src", 'hh');
            });

            //
            $('#roductsadded').on('click', 'li i', function () {
                $(this).parent().remove();
            });
            $('#canceled').click(function () {
                $('#productdata').hide();
            });
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
                return false;
            });
        });
    </script>
@endsection

@endsection
