@extends('layouts.tableWithoutHeader')
@section('content')
  @section('css')
  <style>
  table.dataTable th:nth-child(2),
  table.dataTable th:nth-child(4)
   {
min-width: 150px;      }
  </style>

  @endsection

    <!--page contetnt-->
    <div class="card-header mx-auto">
        <M>Machine Table</M>
    </div>
    <div class="">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class=" ">
                  {!! $dataTable->table(['class' => 'table table-bordered  table-striped text-center']) !!}
            </div>
          </div>

@endsection
@section('js')

<script src="{{asset('vendor/datatables/buttons.server-side.js')}}"></script>
{!! $dataTable->scripts() !!}
@endsection
