<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Description;

class DescriptionController extends Controller
{
    //
    public function addDec(Request $req)
    {
        if ($req->isMethod('get')) {
            return view('stores.decadd');
        } elseif ($req->isMethod('post')) {
            $req->validate([
                'dec' => 'required|min:3',
            ]);
            $dec = new Description();
            $dec->dec = $req->dec;
            $dec->save();
            session()->flash('addeddec', 'added a New Description');
            return back();
//            return Redirect::back()->withErrors(['Sorry You Can\'t Delete That Cause it Has A Users']);
        }
    }
}
