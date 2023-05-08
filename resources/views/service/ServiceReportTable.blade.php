@extends('layouts.tableWithoutHeader')
@section('content')
    <!--page contetnt-->
    <div class="card-header mx-auto">
        <M>Service Report Table</M>
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
           <table class="table  table-striped ">
             {!! $dataTable->table(['class' => 'table table-bordered table-dark table-striped text-center'],true) !!}
            </table>
           </div>
          </div>

@endsection
@section('js')

<script src="{{asset('vendor/datatables/buttons.server-side.js')}}"></script>
{!! $dataTable->scripts() !!}
@endsection
