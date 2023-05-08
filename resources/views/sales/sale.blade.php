@extends('layouts.master')
@section('content')
@section('css')
<style>
table.dataTable th:nth-child(1),
table.dataTable th:nth-child(2),
table.dataTable th:nth-child(3),
table.dataTable th:nth-child(4),
table.dataTable th:nth-child(5),
table.dataTable th:nth-child(6),
table.dataTable th:nth-child(7),
table.dataTable th:nth-child(8),
table.dataTable th:nth-child(9),
table.dataTable th:nth-child(12),
table.dataTable th:nth-child(13),
table.dataTable th:nth-child(14),
table.dataTable th:nth-child(15),
table.dataTable th:nth-child(16),
table.dataTable th:nth-child(17),
table.dataTable th:nth-child(18),
table.dataTable th:nth-child(19),
table.dataTable th:nth-child(20)
 {
  max-width: 60px;
}
table.dataTable th:nth-child(10),
table.dataTable th:nth-child(11){
  max-width: 100px;
}

  </style>
@endsection
<div style="margin-top: 30px" id="sto re" class="tabels col-sm-12">

    <div class="card text-center ">
        <div class="card-header">
            Sales
            <table class=" table-striped table-dark">
                <thead>
                <tr>
                <th scope="col ml-3 pr-2 ">Total Sales</th>
                      </tr>
                      </thead>
                      <tbody>
                      <tr>
                    <td class="bg-danger pl-3 pr-2">
                            <strong>{{$sale}}</strong>
                       </tr>
                       <tr>
                       <div class="costo">

                       </div>
                        </tr>
                       </tbody>
            </table>
        </div>
      </div>
      @if(session()->has('deleteSale'))
          <div class="alert alert-success">{{session()->get('deleteSale')}}</div>
      @endif
            <div class="table-responsive">
             <table class="table  table-striped ">
               {!! $dataTable->table(['class' => 'table table-bordered table-dark table-striped text-center'],true) !!}
            </table>
          </div>
        </div>
        <div class="card-footer text-muted text-center">

        </div>
    </div>
</div>
@endsection
@section('js')

<script src="{{asset('vendor/datatables/buttons.server-side.js')}}"></script>
{!! $dataTable->scripts() !!}
@endsection
