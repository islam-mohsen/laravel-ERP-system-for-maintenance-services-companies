@extends('layouts.master')
@section('css')
<style>
.scroll {
  position: relative;
  width: 100%;
  overflow-x: scroll;
  overflow-y: hidden;
  white-space: nowrap;
  transition: all 0.2s;
  transform: scale(0.98);
  will-change: transform;
  user-select: none;
  cursor: pointer;
}
.scroll.active {
  background: rgba(255,255,255,0.3);
  cursor: grabbing;
  cursor: -webkit-grabbing;
  transform: scale(1);
}
</style>
@endsection
@section('content')
<div style="margin-top: 30px" id="sto re" class="tabels col-sm-12">

    <div class="card text-center ">
        <div class="card-header">
            Store

          <table class=" table-striped table-dark">
              <thead>
              <tr>
              <th scope="col ml-3 pr-2 ">Total stock</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                  <td class="bg-danger pl-3 pr-2">
                        @foreach($storeSumAll as $row)
                          <strong>{{round($row->total,2)}}</strong>
                          @endforeach</td>
                     </tr>
                     <tr>
                    <div class="costo">
                     </div>
                      </tr>
                     </tbody>
          </table>
        </div>
      </div>
            <div class="table-responsive">
               {!! $dataTable->table(['class' => 'table table-bordered table-dark table-striped text-center '],true) !!}
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
<script>
const slider = document.querySelector('.scroll');
let isDown = false;
let startX;
let scrollLeft;

slider.addEventListener('mousedown', (e) => {
  isDown = true;
  slider.classList.add('active');
  startX = e.pageX - slider.offsetLeft;
  scrollLeft = slider.scrollLeft;
});
slider.addEventListener('mouseleave', () => {
  isDown = false;
  slider.classList.remove('active');
});
slider.addEventListener('mouseup', () => {
  isDown = false;
  slider.classList.remove('active');
});
slider.addEventListener('mousemove', (e) => {
  if(!isDown) return;
  e.preventDefault();
  const x = e.pageX - slider.offsetLeft;
  const walk = (x - startX) * 3; //scroll-fast
  slider.scrollLeft = scrollLeft - walk;
  console.log(walk);
});
</script>
@endsection
