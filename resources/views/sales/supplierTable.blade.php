@extends('layouts.main')
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

<div style="margin-top: 30px" id="store" class="tabels col-sm-12">

    <div class="card text-center ">
        <div class="card-header">
            Suppliers table
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
        <div class="card-body">
            <table class="table table-responsive scroll ">
                <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Number</th>
                    <th scope="col">phone</th>
                    <th scope="col">Telephone</th>
                    <th scope="col">Address</th>
                    <th scope="col">Update </th>
                    <th scope="col">Delete</th>

                </tr>
                </thead>
                 <tbody id="myTable">
                 @foreach($vary as $row)
                       <tr class="tr">
                        <th scope="row">{{$row->id}}</th>
                        <td class="part">{{$row->name}}</td>
                        <td class="part">{{$row->number}}</td>
                        <td class="part">{{$row->phone}}</td>
                        <td class="part">{{$row->telephone}}</td>
                        <td class="part">{{$row->address}}</td>
                        <td class="part"><a class="btn btn-primary" href="{{route('supplierUpdate',$row->id) }}">Update </a></td>
                        <td class="part"><a class="btn btn-primary" href="{{ url('supplierDelete/'.$row->id) }}">Delete </a></td>
                    </tr>
                 @endforeach
                 </tbody>
            </table>
        </div>
        <div class="card-footer text-muted text-center">

        </div>
    </div>
</div>
@endsection
@section('js')
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
