<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Suppliers;

class SuppliersController extends Controller
{
    //
    public function addSupplier(Request $req)
    {
        if ($req->isMethod('get')) {
            return view('sales.supplier');
        } else if ($req->isMethod('post')) {
            $req->validate([
                'name' => 'required',
            ]);
            //`id`, `name`, `address`, `phone`, `telephone`
            $supplier = new Suppliers();
            $supplier->name = $req->name;
            $supplier->number = $req->number;
            $supplier->address = $req->address;
            $supplier->phone = $req->phone;
            $supplier->telephone = $req->telephone;
            $supplier->save();
            session()->flash('addedsupplier', 'added a New Supplier');
            return back();
        }
    }
    public function show (){
      $vary = Suppliers::all();
      return view('sales.supplierTable', compact('vary'));
    }

    public function supplierUpdatePage ($id){
      $vary = Suppliers::find($id);
      return view('sales.supplierUpdate', compact('vary'));
    }

    public function update (Request $request, $id) {
      $update = Suppliers::find($id);
      $update->update($request->all());
      session()->flash('updateSupplier', 'updateSupplier');
      return back();
    }

    public function SoftDelete ($id){
      $supplier = Suppliers::find($id);
      $supplier->delete();
      session()->flash('deleteSupplier', 'deleteSuppliers');
      return back();
    }
}
