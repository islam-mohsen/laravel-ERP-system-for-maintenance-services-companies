<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Product_model;
use App\Product_type;

class ProductController extends Controller
{
    //
    public function addProduct(Request $req)
    {
        if ($req->isMethod('get')) {
            return view('stores.addproduct', [
                'brands' => \App\Brand::all(),
                'decs' => \App\Description::all(),
                'room' => \App\Room::all(),
                'type' => \App\Product_type::all(),
            ]);
        } elseif ($req->isMethod('post')) {
            $req->validate([
                'brand' => 'required|numeric',
                'dec' => 'required|numeric',
                'prd_mod' => 'required',
                'room' => 'required|numeric',
                'prd_type' => 'required',
                'part_num' => 'required|unique:products,part_num,' . $req->part_num,
                'min' => 'required|numeric',
            ]);
            //`brand_name_id`, `dec_id`, `part_num`, `prd_mod_id`, `prd_type_id`, `min`, `img`
            $product = new Product();
            $productModel = new Product_model();
            $productModel->prd_mod = $req->prd_mod;
            $productModel->save();

            $product->brand_name_id = $req->brand;
            $product->dec_id = $req->dec;
            $product->part_num = $req->part_num;
            if (isset($req->part_num_hp)) {
                $product->part_num_hp = $req->part_num_hp;
            }
            $product->prd_mod_id = $productModel->id;
            $product->prd_type_id = $req->prd_type;

            $product->cost = $req->cost;

            $product->min = $req->min;
            if (isset($req->img)) {
                $product->img = $req->file('img')->store('upload', 'public');
            } else {
                $product->img = 'upload/images.png';
            }
            $product->save();

            $room = new \App\Room_of_prd();
            $room->part_num_id = $product->id;
            $room->room_id = $req->room;
            $room->quantity = 0;
            $room->save();

            session()->flash('addedproduct', 'added a New Product');
            return back();
//            return Redirect::back()->withErrors(['Sorry You Can\'t Delete That Cause it Has A Users']);
        }
    }

    public function autoCompleteBrand(Request $req)
    {
        if ($req->get('query')) {
            $query = $req->get('query');
            $data = DB::table('brands')
                ->where('name', 'LIKE', "%{$query}%")
                ->get();
            $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
            foreach ($data as $row) {
                $output .= '<li><a href="#">' . $row->country_name . '</a></li>';
            }
            $output .= '</ul>';
            echo $output;
        }
    }
 public function update ($id){
   return view('stores.productUpdate' , [
    'product' => Product::find($id),
    'brands' => \App\Brand::all(),
    'decs' => \App\Description::all(),
    'room' => \App\Room::all(),
    'type' => \App\Product_type::all(),
    'model'=> \App\Product_model::all(),
    'quantity'=> \App\Room_of_prd::where('part_num_id', $id)->first(),
]);
 }
 public function updateProduct (Request $request, $id) {
   $prdpdate = Product::find($id);
   $prdpdate->update($request->all());
   \App\Room_of_prd::select('quantity')
       ->where('part_num_id', $id)
       ->update(['quantity' => request('quantity')]);
    if ($request->has('room_id'))
       {
         \App\Room_of_prd::select('room_id')
             ->where('part_num_id', $id)
             ->update(['room_id' => request('room_id')]);
       }

   session()->flash('updateProduct', 'Update Product');
   return back();


 }
}
