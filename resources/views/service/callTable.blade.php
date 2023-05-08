@extends('layouts.tableWithoutHeader')
@section('content')
    <!--page contetnt-->
    <div class="card-header mx-auto">
        <M>Call Table</M>
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
        <div class="table-responsive">
            <div class="row">
                <div class="col-sm-11">
                  {!! $dataTable->table(['class' => 'table table-bordered table-striped text-center']) !!}
              </div>
            </div>
          </div>
        </div>

@endsection
@section('js')

<script src="{{asset('vendor/datatables/buttons.server-side.js')}}"></script>
{!! $dataTable->scripts() !!}
@endsection
