<?php

namespace App\Http\Controllers;

use App\Product;
use App\Room_of_prd;
use Illuminate\Http\Request;
use \App\Store;
use DB;

class StoreController extends Controller
{
    //
    public function addStore(Request $req)
    {
        if ($req->isMethod('get')) {
            return view('stores.addstore',
                [
                    'store' => \App\Store::all()
                ]);
        } elseif ($req->isMethod('post')) {
//            return $req;
            $req->validate([
                'storename' => 'required',
            ]);
            $store = new Store();
            $store->name = $req->storename;
            $store->save();
            if (!empty(request('room'))) {
                for ($i = 0; count(request('room')) > $i; $i++) {
                    if (!empty(request('room')[$i])) {
                        DB::table('rooms')->insert(
                            [
                                'name_room' => request('room')[$i],
                                'store_id' => $store->id,
                            ]
                        );
                    }
                }
            }
            session()->flash('addedstore', 'added a New Store');
            return back();
        }
    }

    public function deleteStore($id)
    {
        Store::deleteStore($id);
        session()->flash('deletestore', 'Deletes Store');
        return back();
    }

    public function store()
    {
        
        return view('stores.store', [
            'stores' => \App\Room_of_prd::paginate(20),
            'storeSum' => DB::table("products")->sum('cost') ,
            'storeSumAll' => DB::table('products')
                            ->join('room_of_prds', 'products.id', '=', 'room_of_prds.part_num_id')
                            ->select(DB::raw('sum((products.cost + (products.cost * 0.14)) * room_of_prds.quantity) AS total'))
                            ->get()
        ]);
    }

    public function search (Request $request){
        $q=request('Search_Part_number');
        $stores =Room_of_prd::Where('part_num_id', 'LIKE', '%' . $q . '%')->paginate(5);
        return view('search.storeSearch',compact('stores'));
    }


}
