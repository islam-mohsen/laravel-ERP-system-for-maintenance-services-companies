@extends('layouts.main')
@section('content')
@section('css')
@endsection
<div class="card-header mx-auto">
    Authorized Partner Pric
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
    @if(session()->has('addedauth'))
        <div class="alert alert-success">{{session()->get('addedauth')}}</div>
    @endif
    <form action="{{route('auth.add')}}" method="post">
        @csrf
        <div class="form-group">
            <label for="PartNumber">Part Number</label>
            <select name="part_num" id="PartNumber" class="custom-select">
                <option selected> select Part Number</option>
                @foreach($auth as $auth)
                    <option value="{{$auth->id}}">{{$auth->part_num}}</option>
                @endforeach
            </select>
        </div>
        {{--<div id="formdata" class="form-group">--}}
        {{--<label for="num">Model/Part number</label>--}}
        {{--<input name="part_num" type="text" class="form-control" id="num" aria-describedby="emailHelp" placeholder="Enter the name ">--}}

        {{--</div>--}}

        <div id="formdata" class="form-group">
            <label for="auth">Auth</label>
            <input name="name" type="number" class="form-control" id="auth" aria-describedby="emailHelp"
                   placeholder="Enter the name ">

        </div>

        <input type="submit" name="authadd" class="btn btn-primary" value='Submit'/>
    </form>
</div>
</div>
<div class="card col-sm-12 mx-auto mt-5">

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table-striped table-dark">
                <br>
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Auth</th>
                    <th scope="col">Part Number</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">filter</th>
                    <td><input class="form-control" id="auth1" placeholder="Auth" type="text"></td>
                    <td><input class="form-control" id="part" placeholder="Enter p n" type="text"></td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="table-responsive">
            <table class="table  table-striped table-dark">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Auth</th>
                    <th scope="col">Part Number</th>
                    <th scope="col">Part Number HP</th>
                </tr>
                </thead>
                <br>
                <br>
                <tbody id="myTable">
                <?php $i = 0;?>
                @foreach($allauth as $auth)
                    <?php $i++;?>
                    <tr class="tr">
                        <th scope="row">{{$i}}</th>
                        <td class="auth1">{{$auth->auth}}</td>
                        <td class="part">{{$auth->product->part_num}}</td>
                        <td>{{$auth->product->part_num_hp==null ? '___':$auth->product->part_num_hp}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer text-muted text-center">
            {!! $allauth->render()!!}
        </div>

    </div>
    @section('js')
        <script src="js/storedashbord.js"></script>
        <script>
            $(document).ready(function () {
                $('#auth1').keyup(function () {
                    var value = $(this).val().toLowerCase();
                    $('#myTable .tr .auth1').filter(function () {
                        $(this).parent().toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });
                $('#part').keyup(function () {
                    var value = $(this).val().toLowerCase();
                    $('#myTable .tr .part').filter(function () {
                        $(this).parent().toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });
            });

        </script>
@endsection

@endsection
