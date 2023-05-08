@extends('layouts.main')
@section('content')

<div style="margin-top: 30px" id="store" class="tabels col-sm-12">

    <div class="card text-center ">
        <div class="card-header">
            Store
        </div>
        <div class="card-body">
            <table class="table table-striped ">
              <h5>how to edite the quntatiy </h5>
              <p>if you want to edite the Quantity you should enter posititve or negative number to (Edit Quantity)
                FOR EXAMPLE:
                if the engineer has 4 in the quantity and you want to make it 6 you must enter number 2
                but if you want to make it 3 you must enter number -1
              </p>
              <h5> Please do not delete engineer product until you make the quantity zero </h5>
                <thead>
                <tr>
                    <th scope="col">Brand</th>
                    <th scope="col">Model Nubmer</th>
                    <th scope="col">PartNumber</th>
                    <th scope="col">Descreption</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Edit Quantity</th>
                    <th scope="col">Update</th>
                    <th scope="col">Delete</th>
                </tr>
                </thead>
                 <tbody id="myTable">

                 @foreach($engStock->products as $row)
                       <tr class="tr">
                        <td class="part">{{$row->brand->name}}</td>
                        <td class="part">{{$row->prdMod->prd_mod}}</td>
                        <td class="part">{{$row->part_num}}</td>
                        <td class="part">{{$row->dec->dec}}</td>
                        <td class="part">{{$row->pivot->quantity}}</td>
                          <td class="part">
                            <form method="POST" action="{{route('editeEngineersStock',['eng-id'=>$row->pivot->engineer_id,'prd_id'=>$row->id])}}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div  class="form-group">
                            <input name="quantity" type="number" class="form-control"  placeholder="quantity" value="Please enter positive or negative value">
                            </div>
                              </td>
                              <td class="part">
                               <button type="submit" class="btn btn-primary">Update</button>
                               </td>
                           </form>
                 <td class="part">
                   @if ($row->pivot->quantity == 0)
                     <form method="POST" action="{{route('deleteEngineersStock',['eng-id'=>$row->pivot->engineer_id,'prd_id'=>$row->id])}}" enctype="multipart/form-data">
                       @csrf
                       @method('DELETE')
                          <button type="submit" class="btn btn-primary">Delete</button>
                          </td>
                      </form>
                  @else
                   <p>
                     Quantity not 0
                   </p>
                     </td>
                   @endif
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
