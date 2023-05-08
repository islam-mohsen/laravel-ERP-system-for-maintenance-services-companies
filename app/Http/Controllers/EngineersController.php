<?php

namespace App\Http\Controllers;

use App\Engineers;
use Illuminate\Http\Request;

class EngineersController extends Controller
{
    //
    public function index (){
        return view('service.engineer.addEngineers');
    }

    public function store (Request $req){

        Engineers::create($req->all());
        /*$machine = new MachineInformation();
        $machine->name = $req->name;
        $machine->address = $req->address;
        $machine->telephone = $req->telephone;
        $machine->phone = $req->phone;
        $machine->contact_name = $req->contact_name;
        $machine->day_of_week = $req->day_of_week;
        $machine->open_time  = $req->open_time;
        $machine->close_time = $req->close_time;
        $machine->model_number = $req->model_number;
        $machine->machine_serial = $req->machine_serial;
        $machine->machine_place = $req->machine_place;
        $machine->contract = $req->contract;
        $machine->contract_start = $req->contract_start;
        $machine->billing_period = $req->billing_period;
        $machine->minimum_charge = $req->minimum_charge;
        $machine->free_copies = $req->free_copies;
        $machine->excess_copies = $req->excess_copies;
        $machine->notes = $req->notes;

        $machine->save();
  */
        return back();
    }
    public function show (){
      $engineer = Engineers::all();
      return view('service.engineer.showEngineer', compact('engineer'));
    }
    public function engineerUpdatePage ($id){
      $engineer = Engineers::find($id);
      return view('service.engineer.updateEngineer', compact('engineer'));
    }

    public function update (Request $request, $id) {
      $enupdate = Engineers::find($id);
      $enupdate->update($request->all());
      session()->flash('updateEngineer', 'Update Enginner');
      return back();
    }
    public function SoftDelete ($id){
      $engineer = Engineers::find($id);
      if ($engineer->products()->exists()) {
        // code...
        session()->flash('EngineerHasStock', 'EngineerHasStock');
        return back();
      }
      $engineer->delete();
      session()->flash('deleteEngineer', 'Delete Enginner');
      return back();

    }


}
