<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brand;
use Illuminate\Support\Facades\Redirect;

class BrandController extends Controller
{
    //
    public function addBrand(Request $req)
    {
        if ($req->isMethod('get')) {
            return view('stores.brandadd');
        } elseif ($req->isMethod('post')) {

            $req->validate([
                'name' => 'required|min:2|unique:brands,name,' . $req->name,
                'img' => 'required',
            ]);
            $brand = new Brand();
            $brand->name = $req->name;
            $brand->img = $req->file('img')->store('upload', 'public');
            $brand->save();
            session()->flash('addedbrand', 'added New Barand');
            return back();
//            return Redirect::back()->withErrors(['Sorry You Can\'t Delete That Cause it Has A Users']);
        }
    }
}
