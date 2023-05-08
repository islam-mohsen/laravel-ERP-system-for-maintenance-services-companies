<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\SalesMen;
class SalesMenController extends Controller
{
    //
    public function index (){
        return view('sales.salesMen');
    }

    public function store (Request $req){
      $req->validate([
          'name' => 'required',
      ]);
       SalesMen::create($req->all());
       session()->flash('addsalesMen', 'added a New salesMen');
       return back();
       }
}
