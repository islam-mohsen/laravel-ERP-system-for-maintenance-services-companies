<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Engineers;
use App\EngineerProduct;
use App\Product;
use App\Room_of_prd;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\DB;
class EngineerProductController extends Controller
{
    //
    public function index ($id){
     $engStock = Engineers::find($id);

    //  $engStock = EngineerProduct::selectRaw('engineer_products.quantity,  products.part_num)->
      //      join('products' , 'products.id' ,'=' , 'engineer_products.product_id')->
      //      join('engineers' , 'engineers.id' , '=' , 'engineer_products.engineer_id')->
      //      get() ;
     // $engStock = EngineerProduct::all()->where('engineer_id', $id);
      return view('service.engineer.showEngineerStock', compact('engStock'));

    }
    public function addStock ($id){
       $eng = Engineers::find($id);
      $prd = \App\Product::select('id', 'part_num')->get();
      return view('service.engineer.addEngineerStock', compact('prd','eng'));
    }
public function store (Request $request,$id){
  $eng   = Engineers::findOrFail($id);
    // It exists
  $eng_prd = new EngineerProduct();
  for ($i = 0; count(request('product_id')) > $i; $i++) {
    if (EngineerProduct::where('engineer_id', $eng->id)->where('product_id',request('product_id')[$i])->first()) {
       return '<h1>the enginner has this product you can update it from Enginner table </h1>';
} else {
    DB::table('engineer_products')->insert(
    [   'engineer_id' => $eng->id,
        'product_id' => request('product_id')[$i],
        'quantity' => request('quantity')[$i],
       ]);
       $roomof = \App\Room_of_prd::select('quantity')
           ->where('part_num_id', request('product_id')[$i])->get()[0];

       \App\Room_of_prd::select('quantity')
               ->where('part_num_id', request('product_id')[$i])
               ->update(['quantity' => $roomof->quantity - request('quantity')[$i]]);
  }

}
session()->flash('addedEngineerStock', 'added product to engineer');

  return back();
}
//     return redirect('admin/view/'.$call->id.'/showReport')->with('msg','The report for specif Call Created');


public function edite ( Request $request,$eng_id,$prd_id){
  //  DB::enableQuerylog();
  //   $req =  request('quantity');
  $engoo = EngineerProduct::select('quantity')
         ->where(['engineer_id'=>$eng_id,'product_id'=>$prd_id])->first();;
  EngineerProduct::select('quantity')
          ->where(['engineer_id'=>$eng_id,'product_id'=>$prd_id])
          ->update(['quantity' => $engoo->quantity + request('quantity')]);

          $roomof = \App\Room_of_prd::select('quantity')
              ->where('part_num_id', $prd_id)->first();
          \App\Room_of_prd::select('quantity')
                      ->where('part_num_id', $prd_id)
                      ->update(['quantity' => $roomof->quantity - request('quantity')]);
  //DB::update("UPDATE `engineer_products` SET quantity = $qty WHERE 'engineer_id'= $eng_id AND 'product_id' = $prd_id ");


  return back();

}
public function destroy ( Request $req,$eng_id,$prd_id){
    DB::enableQuerylog();
  EngineerProduct::where(['engineer_id'=>$eng_id,'product_id'=>$prd_id])->delete();
  return back();

}

}
