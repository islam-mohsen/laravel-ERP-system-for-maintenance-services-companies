@extends('layouts.master')
@section('content')
@section('css')
<style>
tr {border-color: red;}
  </style>
@endsection
<div style="margin-top: 30px" id="sto re" class="tabels col-sm-12">

    <div class="card text-center ">
        <div class="card-header">
            Product Cards
          </div>
      </div>
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
