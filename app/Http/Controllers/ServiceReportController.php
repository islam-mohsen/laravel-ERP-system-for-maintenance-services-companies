<?php

namespace App\Http\Controllers;

use App\Call;
use App\Report;
use App\ServiceReport;
use App\MachineInformation;
use App\Engineers;
use App\Product;
use App\EngineerProduct;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ServiceReportController extends Controller
{
    //
    public function index($call,$eng){

      $call = Call::findOrFail($call);

      if($call->machineInformation->machineReport){
        $reporto = $call->machineInformation->machineReport->last();
      }
      else {
            $reporto = null ;
           }
        $eng = Engineers::findOrFail($eng);
        $prd = $eng->products;

        return view('service.addReport',compact('call','eng','prd','reporto'));
    }
    public function store (Request $request,$call,$eng){
        $callo   = Call::findOrFail($call);
        $engo = Engineers::findOrFail($eng);
        $input  = $request->all();
        $input['call_id'] = $callo->id;
        $input['machine_information_id'] = $callo->machineInformation->id;
        $input['engineers_id'] = $engo->id;
         ServiceReport::create($input);
   //     $call->reports()->save($report);
if (!empty(request('quantity')[0])){
for ($i = 0; count(request('product_id')) > $i; $i++) {
  //   if (EngineerProduct::whereIn('engineer_id', $eng)->whereIn('product_id',request('product_id')[$i])->where('quantity','>',request('quantity')[$i])->get()[0]) {
  //      return 'the quantity in report is bigger than engineer quantity ';
// } else {
$lastId = DB::table('service_reports')->latest('id')->first()->id;
     DB::table('report_products')->insert(
     [   'service_report_id' => $lastId,
         'product_id' => request('product_id')[$i],
         'quantity' => request('quantity')[$i],
        ]);
        $engof = \App\EngineerProduct::select('quantity')
        ->where('engineer_id', $eng)->where('product_id',request('product_id')[$i])->get()[0];

        \App\EngineerProduct::select('quantity')
                ->where('engineer_id', $eng)->where('product_id',request('product_id')[$i])
                ->update(['quantity' => $engof->quantity - request('quantity')[$i]]);
//   }
        }
       }
        session()->flash('addedReport', 'added a new Report');
        return back();

   //     return redirect('admin/view/'.$call->id.'/showReport')->with('msg','The report for specif Call Created');
    }

    public function viewReport($id){

        $call = Call::findOrFail($id);
        return view('service.viewReport',compact('call'));
       }

  public function printReport($id){

        $call = Call::findOrFail($id);

      if($call->machineInformation->machineReport){
        $reporto = $call->machineInformation->machineReport->last();
        return view('service.printReport',compact('call','reporto'));

      }
  else{
    $reporto = null;
    return view('service.printReport',compact('call','report'));
          }
    }
    public function choose($id){

       $eng = Engineers::all();
       $call = Call::findOrFail($id);
       return view('service.chooseEnginner',compact('eng','call'));
    }
}
