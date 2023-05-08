<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product_type;
class ProductTypeController extends Controller
{
    //
    public function index (){
      return view('stores.addProductType');
    }

    /*    save type  */
    public function store (Request $req){
    $type = new Product_type();
    $type->prd_type  = $req->type;
    $type->save();
    session()->flash('addetype', 'added a New Product Type');
    return back();
    }

}
