<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Customer;
class CustomerController extends Controller
{
    //
    public function index (){
        return view('sales.customer');
    }

    public function store (Request $req){
      $req->validate([
          'name' => 'required',
      ]);
       Customer::create($req->all());
       session()->flash('addCustomer', 'added a New Customer');
       return back();
       }

       public function show (){
         $vary = Customer::all();
         return view('service.customerTable', compact('vary'));
       }

       public function customerUpdatePage ($id){
         $vary = Customer::find($id);
         return view('service..updateCustomer', compact('vary'));
       }

       public function update (Request $request, $id) {
         $update = Customer::find($id);
         $update->update($request->all());
         session()->flash('updateCustomer', 'UpdateCustomer');
         return back();
       }

       public function SoftDelete ($id){
         $customer = Customer::find($id);
         $customer->delete();
         session()->flash('deleteCustomer', 'DeleteCustomer');
         return back();
       }
}
