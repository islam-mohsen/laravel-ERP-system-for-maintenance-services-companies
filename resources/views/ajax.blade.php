@extends('layouts.app2')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
@endsection
@section('content')
    {{auth()->user()->level_id}}
    <form id="f" method="post">
        @csrf
        <input type="text" id="tex">
        <input type="submit" name="" id="sub">
    </form>
    <div id="re">

    </div>
@section('js')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function () {
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
