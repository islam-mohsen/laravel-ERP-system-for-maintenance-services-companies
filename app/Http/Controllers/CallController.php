<?php

namespace App\Http\Controllers;

use App\Call;
use App\MachineInformation;
use App\ServiceReport;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\Datatables\Datatables;
class CallController extends Controller
{
    public function index (){
     $machineInfos = MachineInformation::all();

        return view('service.addCall')->withMachineInfos($machineInfos);
    }

    public function store (Request $req){

    /*    Call::create($req->all());  */
        $callo = new Call();
        $callo->machine_information_id = $req->machine_information_id;
        $callo->call_date = now();
        $callo->call_time = now();
        $callo->call_type = $req->call_type;
        $callo->problem = $req->problem;

        $callo->save();
        session()->flash('addedCall', 'added a New Call');
        return back();
    }
    public function callTable (){
   $call = Call::all();
  //  $reports = Call::take(-2);
       return view('service.callTable');
    }
  //  public function callDataTable (){
      //$call = Call::with('machineInformation');
  //    $reports = Call::take(-2);
  //      return view('service.callTable')->withCall($call)->withReports($reports);
    //return Datatables::of(Call::query())->make(true)->addColumn('machineInformation', '{{$call->machineInformation->id}}')->toJson();
//    return DataTables::of($call)
    //->addColumn('machineInformation', function($call) {
      //    return  $call->machineInformation->name; })

  //  ->addColumn('link', function($call) {
      //     return '<a class="btn btn-primary" href="'.url('viewReport/'.$call->id).'">View reports</a>';
    //      })
  //  ->rawColumns(['machineInformation', 'link'])
//    ->toJson();
public function updatePage ($id) {
  $update = Call::find($id);
  return view('service.CallUpdate',compact('update'));
}

public function updateCall (Request $request, $id) {
  $maupdate = Call::find($id);
  $maupdate->update($request->all());
  session()->flash('updateCall', 'Update Call');
  return back();
  }
  public function uncompleted (){
  $callo =  Call::has('servicereports')->get();
  //return dd($callo);
  return view('service.uncompletedCall',compact('callo'));

  }
  public function delete ($id){
    $call = Call::find($id);
     $call->delete();
   return back();
 }

}
