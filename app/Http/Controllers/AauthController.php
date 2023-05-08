<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Aauth;
use App\Product;

class AauthController extends Controller
{
    //
    public function addAuth(Request $req)
    {
        if ($req->isMethod('get')) {
            return view('stores.auth', [
                'auth' => Product::all(),
                'allauth' => Aauth::paginate(20)
            ]);
        } elseif ($req->isMethod('post')) {
            $req->validate([
                'name' => 'required|numeric',
                'part_num' => 'required|numeric',
            ]);
            $auth = new Aauth();
            $auth->part_num = $req->part_num;
            $auth->auth = $req->name;
            $auth->save();
            session()->flash('addedauth', 'added New Auth');
            return back();
//            return Redirect::back()->withErrors(['Sorry You Can\'t Delete That Cause it Has A Users']);
        }
    }

}
