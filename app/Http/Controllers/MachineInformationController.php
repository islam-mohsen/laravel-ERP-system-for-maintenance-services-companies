<?php

namespace App\Http\Controllers;

use App\MachineInformation;
use App\Engineers;

use Illuminate\Http\Request;

class MachineInformationController extends Controller
{
    public function index (){
$eng  = Engineers::all();
return view('service.addMachine',compact('eng'));
    }

  public function store (Request $req){

    MachineInformation::create($req->all());
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
    session()->flash('addedMachine', 'added a New Machine');
      return back();
}

public function table (){

$info = MachineInformation::all();
return view('service.machinetable',compact('info'));
}

public function updatePage ($id) {
  $update = MachineInformation::find($id);
  $eng  = Engineers::all();
  return view('service.machineUpdate',compact('update','eng'));
}

public function updateMachine (Request $request, $id) {
  $maupdate = MachineInformation::find($id);
  $maupdate->update($request->all());
  session()->flash('updateMachine', 'Update Machine');
  return back();
}
public function machineReports ($id){
  $machine = MachineInformation::find($id);

  return view('service.machineReports',compact('machine'));

}
}
