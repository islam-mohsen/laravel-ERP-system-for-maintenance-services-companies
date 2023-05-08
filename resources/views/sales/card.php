@extends('layouts.stdash')
@section('content')
@section('css')
@endsection
<div style="margin-top: 30px" id="seals e" class="tabels col-sm-12">
    <div class="card text-center ">
        <div class="card-header">
            Store
        </div>
        <div class="card-body">
            {{--            <label for="">Date</label>--}}
            {{--            <input class="form-control" type="date" id="date">--}}
            <div class="table-responsive">
                <table class=" table-striped table-dark">

                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Part Number</th>
                        <th scope="col">Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">filter</th>
                        <td><input class="form-control" id="part" placeholder="Enter p n" type="text"></td>
                        <td><input class="form-control" type="date" id="date"></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="table-responsive">
                <table class="table  table-striped table-dark">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Cost</th>
                        <th scope="col">Come</th>
                        <th scope="col">Leave</th>
                        <th scope="col">Action</th>
                        <th scope="col">Part Number</th>
                        <th scope="col">Part Number HP</th>
                        <th scope="col">Count Of</th>
                        <th scope="col">Date</th>
                    </tr>
                    </thead>
                    <br>
                    <br>
                    <tbody id="myTable">
                    <?php $i = 0;?>
                    @foreach($cards as $card)
                        <?php $i++; ?>
                        <tr class="tr">
                            <th scope="row">{{$i}}</th>
                            <td class="eng">{{$card->cost}}</td>
                            <td class="eng">{{$card->come}}</td>
                            <td class="customer">{{$card->leave}}</td>
                            <td> {{$card->actions}}</td>
                            <td class="part">{{$card->prds->part_num}}</td>
                            <td class="">{{$card->prds->part_num_hp==null?'vv':$card->prds->part_num_hp }}</td>
                            <td>{{$card->count_of}}</td>
                            <td class="date">{{$card->date}}</td>

                            {{--                            <td class="dec">{{$sale->prds->dec->dec}}</td>--}}
                            {{--                            <td class="brand">{{$sale->prds->brand->name}}</td>--}}
                            {{--                            <td class="model">{{$sale->prds->prdMod->prd_mod}}</td>--}}
                            {{--                            --}}{{--                            <td>{{$sale->sale}}</td>--}}
                            {{--                            --}}{{--                            <td>{{$sale}}</td>--}}
                            {{--                            <td>{{$sale->quantity}}</td>--}}
                            {{--                            <td>{{$sale->sale->cost}}</td>--}}
                            {{--                            <td>{{$sale->quantity * $sale->sale->cost}}</td>--}}
                            {{--                            <td>--}}
                            {{--                                @if($sale->sale->tax == 1 )--}}
                            {{--                                    {{$sale->sale->cost * app('tax')}}--}}
                            {{--                                @else--}}
                            {{--                                    0--}}
                            {{--                                @endif--}}
                            {{--                            </td>--}}
                            {{--                            <td>--}}
                            {{--                                @if($sale->sale->tax == 1 )--}}
                            {{--                                    {{($sale->quantity * $sale->sale->cost)*app('tax')}}--}}
                            {{--                                @else--}}
                            {{--                                    0--}}
                            {{--                                @endif--}}
                            {{--                            </td>--}}
                            {{--                            <td class="type">{{$sale->prds->type->prd_type}}</td>--}}
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer text-muted text-center">
            {!! $cards->render()!!}
        </div>
    </div>
</div>
@section('js')
    <script src="js/storedashbord.js"></script>
    <script>
        $('#part').keyup(function () {
            // console.log($(this).val())
            var value = $(this).val().toLowerCase();
            $('#myTable .tr  .part').filter(function () {
                $(this).parent().toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        $('#date').change(function () {
            // console.log($('#date').val())
            var value = $(this).val().toLowerCase();
            $('#myTable .tr .date').filter(function () {
                $(this).parent().toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    </script>
@endsection
@endsection
