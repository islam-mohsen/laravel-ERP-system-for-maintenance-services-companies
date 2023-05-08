<?php

namespace App\Http\Controllers;

use \App\Sale;
use \App\Card;
use \App\Customer;
use \App\Sales_from;
use Illuminate\Http\Request;
use DB;

class SaleController extends Controller
{
    //

    public function addSale(Request $req)
    {
        if ($req->isMethod('get')) {
            return view('sales.salepro', [
            'part_num' => \App\Product::select('id', 'part_num')->get(),
                'eng' => \App\Engineers::select('id', 'name')->get(),
                'customer' => \App\Customer::select('id', 'name')->get(),
                'sales' => \App\SalesMen::select('id', 'name')->get(),
            ]);
        } elseif ($req->isMethod('post')) {
            $req->validate([
                'date' => 'required',
                'name_emp' => 'required',
                'customers_id' => 'required',

            ]);
            $sale = new Sale();
            $sale->company = $req->company;
            $sale->invoice_number = $req->invoice_number;
            $sale->engineers_id = $req->engineers_id;
            $sale->customers_id = $req->customers_id;
            $sale->sales_mens_id = $req->sales_mens_id;
            $sale->name_emp = $req->name_emp ;
            $sale->date = $req->date;
            if (request('tax') == 1) {
                $sale->tax = $req->tax;
            } else {
                $sale->tax = 0;
            }
            if (request('check') == 1) {
                $sale->check_num = $req->check_num;
                $sale->check = $req->check;
            } else {
                $sale->check_num = 0;
                $sale->check = 0;
            }
//            $sale->save();
            $card = new Card();
            for ($i = 0; count(request('part_num')) > $i; $i++) {
                $roomof = \App\Room_of_prd::select('quantity')
                    ->where('part_num_id', request('part_num')[$i])->get()[0];
                if (($roomof->quantity - request('quantity')[$i]) >= 0) {
                    if ($i == 0) {
                        $sale->save();
                    }
                    DB::table('sales_froms')->insert(
                        [
                            'part_num_id' => request('part_num')[$i],
                            'quantity' => request('quantity')[$i],
                            'price' => request('price')[$i],
                            'sale_id' => $sale->id,

                        ]
                    );
                    \App\Room_of_prd::select('quantity')
                        ->where('part_num_id', request('part_num')[$i])
                        ->update(['quantity' => $roomof->quantity - request('quantity')[$i]]);
                    //`prt_num_id`, `actions`, `come`, `leave`, `count_of`, `price`, `date`
                    $card->store(request('part_num')[$i], request('sales_mens_id'), null, request('quantity')[$i],
                        $roomof->quantity - request('quantity')[$i], request('price')[$i],Customer::find($req->customers_id)->name,NULL, \Carbon\Carbon::now()->toDateString());
                } else {
                    session()->flash('enough', 'Sorry there is Product do not Has quantity enough');
                    return back();
                }
            }
            session()->flash('addedsale', 'added a New Sale');
            return back();
        }
    }

    public function partNum()
    {
        //request('prNum')
        if (request()->ajax()) {
            $search = request('prNum');
            return response()->json(
                \App\Product::where('part_num', 'LIKE', "%$search%")
                    ->with('dec')
                    ->with('prdMod')
                    ->with('type')
                    ->get()[0]
            );
        }
    }

    public function sale()
    {
        return view('sales.sale', [
            'sales' => \App\Sales_from::paginate(20)
        ]);
    }

    public function dashboard()
    {
        return view('stores.dashboard', [
            'sales' => \App\Sales_from::select('*')->get(),
            'stores' => \App\Room_of_prd::all()
        ]);
    }

    public function saleDate()
    {
        if (request()->ajax()) {
            return DB::table('sales_froms')
                ->join('products', 'sales_froms.part_num_id', '=', 'products.id')
//                ->join('sales', 'sales_froms.part_num_id', '=', 'sales.id')
                ->join('descriptions', 'products.dec_id', '=', 'descriptions.id')
                ->select('sales_froms.quantity', 'products.*', 'descriptions.dec')
                ->get();
            return \App\Sales_from::all();
        }
    }
    public function delete ($id)
    {
      $SaleFrom =  \App\Sales_from::find($id);
      $saleQuantity = $SaleFrom->quantity ;
      $prdID = $SaleFrom->prds->id ;

      $roomof = \App\Room_of_prd::select('quantity')
        ->where('part_num_id', $prdID)->first();
     \App\Room_of_prd::select('quantity')
         ->where('part_num_id', $prdID)
         ->update(['quantity' => ($roomof->quantity + $saleQuantity)]);

       $SaleFrom->delete();
       session()->flash('deleteSale', ' Sales Invoice Deleted');
       return back();
     }

  }
