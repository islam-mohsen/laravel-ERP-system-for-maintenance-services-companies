@extends('layouts.master')
@section('content')
@section('css')
@endsection
<div style="margin-top: 30px" id="dashbord" class="tabels col-sm-12">
    <div class="row">
        <div class="stoc col-sm-6">
            <!--minimum data card -->
            <div class="card text-center ">
                <div class="card-header">
                    minimum product stored
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="table-wrapper-scroll-y">
                            <table class="table  table-striped table-dark">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Part Number</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Min</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 0;?>
                                @foreach($stores as $store)
                                    @if($store->quantity <= $store->prds->min)
                                        <?php $i++; ?>
                                        <tr>
                                            <th scope="row">{{$i}}</th>
                                            <td class="bg-danger">{{$store->prds->part_num}}</td>
                                            <td class="bg-danger">{{$store->quantity}}</td>
                                            <td class="bg-danger">{{$store->prds->min}}</td>
                                        </tr>
                                    @endif
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end minimum data card-->
        <div class="stoc col-sm-6">
            <div class="card text-center ">
                <div class="card-header">
                    Total Sales By Day
                </div>
                <div class="card-body">
                    <div class="row">
{{--                        <input class="form-control" id="date" type="date">--}}
                        <div style=" margin-top: 10px; max-height: 252px !important;"
                             class="table-wrapper-scroll-y">
                            <table class="table  table-striped table-dark">
                                <thead>
                                <tr>
                                    <th scope="col">tootal price</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th id="total" class="bg-success" scope="row">0</th>
                                </tr>
                                </tbody>
                            </table>
                            <table class="table  table-striped table-dark">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">part number</th>
                                    <th scope="col">Discreption</th>
                                    <th scope="col">quantity</th>
                                    <th scope="col">price</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 0;
                                $mytime = \Carbon\Carbon::now();
                                ?>
                                @foreach($sales as $sale)
                                    {{--@if($sale->sale->date == '2019-02-05')--}}
                                    @if($sale->sale->date == $mytime->toDateString())
                                        <?php $i++; ?>
                                        <tr class="tr">
                                            <th scope="row">{{$i}}</th>
                                            <td class="bg-success">{{$sale->prds->part_num}}</td>
                                            <td class="bg-success">{{$sale->prds->dec->dec}}</td>
                                            <td class="bg-success">{{$sale->quantity}}</td>
                                            <td class="cost-{{$i}} bg-success">{{$sale->sale->cost}}</td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

@section('js')
    <script src="js/storedashbord.js"></script>

    <script>
        $(document).ready(function () {
            var tr = $('.tr').length;
            var cost = [];
            var sum;
            for (var i = 1; i <= $('.tr').length; i++) {
                cost.push(parseInt($('.cost-' + i).text()));
                sum += cost[i];
            }
            var r = 0;
            $.each(cost, function (i, v) {
                r += +v;
            });
            $('#total').text(r);
            $('#date').change(function () {
                console.log($('#date').val())
                $.ajax({
                    type: 'get',
                    url: '{{route("saleDate")}}',
                    // data: dataString,
                    // dataType: 'json',
                    success: function (data) {
                        console.log(data)


                    }
                });

            });

        });
    </script>
@endsection
@endsection
