<?php

namespace App\Http\Controllers;

use App\Product;
use App\Suppliers;
use Illuminate\Http\Request;
use \App\Buy_product;
use \App\BuyItem;
use \App\Card;
use DB;

class BuyProductController extends Controller
{
    //
    public function addBuy(Request $req)
    {
        if ($req->isMethod('get')) {
            return view('sales.buy', [
                'part_num' => \App\Product::select('id', 'part_num')->get(),
                'supplier' => \App\Suppliers::select('id', 'name')->get(),
            ]);
        } elseif ($req->isMethod('post')) {
            $req->validate([
                'invoice' => 'required',
                'emp_name' => 'required',
                'date' => 'required',
                'supplier' => 'required',
            ]);
            //`invoice_number`, `prt_num_id`, `prd_mod_id`, `supplier_id`, `quantity`, `name_emp`, `price`, `tax`, `check_num`, `check`, `date`
            $buy = new Buy_product();
            $buy->invoice_number = $req->invoice;
            $buy->supplier_id = $req->supplier;
            $buy->name_emp = $req->emp_name;
            $buy->date = $req->date;
            if (request('tax') == 1) {
                $buy->tax = $req->tax;
            } else {
                $buy->tax = 0;
            }
            if (request('check1') == 1) {
              $buy->check = $req->check1;
              $buy->check_num  = $req->check_num;
            } else {
              $buy->check = 0;
              $buy->check_num = 0;
            }
            $card = new Card();
            for ($i = 0; count(request('part_num')) > $i; $i++) {
              if ($i == 0) {
                $buy->save();
              }
            DB::table('buy_items')->insert(
            [
             'product_id' => request('part_num')[$i],
             'quantity' => request('quantity')[$i],
             'price'=> request ('price')[$i],
             'buy_product_id' => $buy->id,
              ]
            );
        $roomof = \App\Room_of_prd::select('quantity')
         ->where('part_num_id', request('part_num')[$i])->get()[0];
        \App\Room_of_prd::select('quantity')
          ->where('part_num_id', request('part_num')[$i])
          ->update(['quantity' => $roomof->quantity + request('quantity')[$i]]);

        $product =\App\Product::where('id', request('part_num')[$i])->get()[0];

         if ($roomof->quantity == 0)
            {
              \App\Product::select('cost')
               ->where('id', request('part_num')[$i])
               ->update(['cost' => (request('price')[$i])]);
                   }
         else {
              \App\Product::select('cost')
                ->where('id', request('part_num')[$i])
                ->update(['cost' => ($product->cost + request('price')[$i])/2]);
                  }
          //`prt_num_id`, `actions`, `come`, `leave`, `count_of`, `price`,'customer','supplier',`date`
          $card->store(request('part_num')[$i], null,request('quantity')[$i], null,
          ($roomof->quantity + request('quantity')[$i]),request('price')[$i],null,Suppliers::find($req->supplier)->name,\Carbon\Carbon::now()->toDateString());

        }
            session()->flash('addedBuy', 'added a New Buy');
            return back();
        }
    }

    public function purchases()
    {
        return view('sales.showbuy', [
            'buys' => \App\BuyItem::orderBy('id', 'desc')->paginate(5)

        ]);
    }
    public function delete ($id)
    {
      $buyItem = BuyItem::find($id);
      $buyQuantity = $buyItem->quantity ;
      $prdID = $buyItem->product->id ;

      $roomof = \App\Room_of_prd::select('quantity')
        ->where('part_num_id', $prdID)->first();
     \App\Room_of_prd::select('quantity')
         ->where('part_num_id', $prdID)
         ->update(['quantity' => ($roomof->quantity - $buyQuantity)]);

       $buyItem->delete();
       return back();
     }
}
