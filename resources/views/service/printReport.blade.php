@extends('layouts.main')
@section('css')
  <style>
  table,td,tr,th {
    border: 2px solid black;
  }
  .noborder{
    border: none;
  }
  .nobottombord {
    border-bottom: none;
  }
h3 {
  padding-left: 40%;
  font-size: 30px;
  display: inline;
}
</style>
@endsection
@section('content')
<!---   <div class="card-header mx-auto">
        <M>Service Reports</M>
    </div> -->
<div class="container">
<div class='printpage'>
     <table class="table noborder mb-0 text-center">
       <tbody>
          <tr class="noborder">
            <td  class="noborder"> <img src="https://www.gosmartsystem.com/smartAccount/public/logo.png" height="80" alt="copy com"> </td>
            <h3 calss="headero">Service Report</h3>
            <td height="80"class="float-right noborder"><h4>الشركة المصرية لصيانة مهمات المكاتب </h4>
              <p> ماكينات تصوير مستندات - رسومات هندسية</p>
              <p>Tel: 24051728 - 24051684 - 24051822</P>
          </td>
         </tr>
       </tbody>
     </table>
   <h4 style="display: inline;"> Call Details </h4>
      <table class="table  table-primary  text-center">
              <tr style=" line-height: 10px; ">
                <th>Call type </th>
                  <th>Call number </th>
                    <th>Call date </th>
                      <th>Call time </th>
                      <th>Problem </th>
                    </tr>
                <tbody>
                   <tr style=" line-height: 10px; ">
                     <td>{{$call->call_type }}</td>
                       <td>{{$call->id}}</td>
                         <td>{{$call->call_date}}</td>
                           <td>{{$call->call_time}}</td>
                           <td>{{$call->problem}}</td>
                      </tr>
                  </tbody>
            </table>
  <!--- machineInformation table -->
    <h4>Customer Details</h4>
        <table  class="table   table-success text-center">
           <tr style=" line-height: 10px; ">
              <th scope="col">Customer Name </th>
              <th scope="col">Model</th>
              <th scope="col">M/C Serial </th>
                <th scope="col" colspan="3">Address </th>
              </tr>
          <tbody>
            <tr style=" line-height: 10px; ">
              <td class="">{{$call->machineInformation->name}}</td>
              <td class="">{{$call->machineInformation->model_number}}</td>
              <td class="">{{$call->machineInformation->machine_serial}}</td>
              <td  colspan="3">{{$call->machineInformation->address}}</td>
            </tr>
          </tbody>
          <tr style=" line-height: 10px; ">
            <th scope="col">Contact Name </th>
            <th scope="col">Phone </th>
            <th scope="col">Telephone </th>
            <th scope="col">Days of</th>
            <th scope="col" colspan="2">Working time </th>
          </tr>
      <tbody>
         <tr style=" line-height: 10px; ">
         <td rowspan="2" class="">{{$call->machineInformation->contact_name}}</td>
         <td  rowspan="2" class="">{{$call->machineInformation->phone}}</td>
         <td  rowspan="2" class="">{{$call->machineInformation->telephone}}</td>
         <td  rowspan="2" class="">{{$call->machineInformation->day_of_week}}</td>
         <td >Openinig Time </td>
         <td >Closing Time </td>
        </tr>
         <tr style=" line-height: 10px; ">
         <td class="">{{$call->machineInformation->open_time}}</td>
         <td class="">{{$call->machineInformation->close_time}}</td>
        </tr>
      </tbody>
    </table>
  <!----- Engineers info ---->
    <h4>Engineer Call</h4>
   <table class="table table-success  text-center">
       <tr style=" line-height: 10px; ">
         <th scope="col">Engineer Territory </th>
          <th scope="col">Dispatched To </th>
          <th scope="col" colspan="3">Date of visit  </th>
          <th scope="col">Meter reading </th>
      </tr>
      <tbody>
     <tr  style=" line-height: 10px; ">
          <td  rowspan="2" >{{$call->machineInformation->engineer->name}}</td>
          <td  rowspan="2" ></td>
          <th>Day</td>
          <th>Month</td>
          <th>Year</td>
          <td rowspan="2"></td>
     </tr>
     <tr style=" line-height: 10px; ">
     <td ></td>
     <td ></td>
     <td ></td>
     </tr>
   </tbody>
  </table>
 <table class="table   table-success text-center">
     <tr style=" line-height: 10px; ">
        <th  colspan="2">Travil time </th>
        <th  colspan="2">Work time  </th>
        <th  colspan="2">Job complete </th>
    </tr>
   <tr style=" line-height: 10px; ">
     <th >Cust</th>
     <th>Store</th>
     <th>Job Start</th>
     <th>Job End</th>
     <th>Yes</th>
     <th>No</th>
   </tr>
 <tbody>
   <tr height="20">
        <td ><p></p></td>
        <td ><p></p></td>
        <td ><p></p></td>
        <td ><p></p></td>
        <td ><p></p></td>
        <td ><p></p></td>
 </tbody>
</table>
<h4>Last visit</h4>
      <table class="table  table-primary   text-center">
              <tr style=" line-height: 10px; ">
                <th>Date </th>
                  <th>Meter</th>
                  <th>engineer</th>
                    <th>Repair / Work / Comments </th>
                    </tr>
                  @if($reporto)
                  <tbody>
                     <tr style=" line-height: 9px; ">
                       <td class="">{{$reporto->visite_date }}</td>
                         <td class="">{{$reporto->meter_reading}}</td>
                         <td class="">{{$reporto->engineers->name}}</td>
                           <td class="">{{$reporto->comments}}</td>
                        </tr>
                    </tbody>
                  @else
                  <tbody>
                     <tr style=" line-height: 10px; ">
                       <td class="">no machine history</td>
                         <td class="">no machine history</td>
                           <td class="">no machine history</td>
                           <td class="">no machine history</td>
                        </tr>
                    </tbody>
                  @endif
            </table>
<table class="table   text-center">
    <tr style=" line-height: 10px; ">
      <th>#</th>
      <th style="" >Spare parts</th>
      <th style="width:30px">quantity</th>
      <th>Repair / Work / Comments</th>
    </tr>
  <tbody style=" line-height: 10px; ">
    <tr >
      <th scope="row">1</th>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <th scope="row">4</th>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <th scope="row">5</th>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <th scope="row">6</th>
      <td></td>
      <td></td>
      <td></td>
    </tr>
  </tbody>
</table>
<!--- Customer signature--->
<table class="table text-center">
  <tbody>
    <tr>
       <td height="70" class="noborder float-left"><p><u>Customer note</u></p></td>
       <td height="70" class="noborder float-right"><p><u>ملاحاظات العميل</u></p></td>
   </tr>
 </tbody>
</table>
 <table class="table  text-center  h-50">
   <tbody class="noborder ">
     <tr class="noborder ">
      <td height="20" class="noborder ">
       <table class=" table  text-center noborder table-borderless">
       <tr class="noborder ">
         <td height="20" class="noborder "><p>THE M/C IS IN WORKING CONDATION AND METER READINGS ARE CORRECT
           AND THE ABOVE SPARE PARTS HAVE INSTALIED IN MACHINE (IF ANY)</p>
           <p>الماكينة تعمل بحالة جيدة وقراءة العدادات سليمة وتم تركيب قطع الغيار المذكورة</p>
         </td>
       </tr>
       <tr class="noborder ">
         <td height="33" class="noborder  float-left"><p><u>Customer Signature</u></p></td>
         <td height="33" class="noborder  float-right"><p><u>توقيع العميل</u></p></td>
       </tr>
       <tr class="noborder">
         <td  height="33" class="noborder float-left"><p><u>Customer Name</u></p></td>
         <td height="33"  class="noborder  float-right"><p><u>الاسم</u></p></td>
       </tr>
       </table>
     </td>
      <td height="20" class="w-25">
        ENG. NAME
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
       DATE
    </td>
 </tr>
 </tbody>
</table>
   </div>
  <div class="float-right">
   <button type="button" id='print' class="btn btn-info">Print this page</button>
     </div>
@endsection
@section('js')
<script src="{{asset('js/printThis.js')}}"></script>
<script>
  $('#print').click(function(){
    $('.printpage').printThis({
      debug: false,               // show the iframe for debugging
      importCSS: true,            // import parent page css
      importStyle: true,         // import style tags
      printContainer: false,       // print outer container/$.selector
      loadCSS: "{{asset('vendor/bootstrap/css/bootstrap.min.css')}}",                // path to additional css file - use an array [] for multiple
      pageTitle: null,              // add title to print page
      removeInline: false,        // remove inline styles from print elements
      removeInlineSelector: "*",  // custom selectors to filter inline styles. removeInline must be true
      printDelay: 333,            // variable print delay
      header: null,               // prefix to html
      footer: null,               // postfix to html
      base: false,                // preserve the BASE tag or accept a string for the URL
      formValues: true,           // preserve input/form values
    doctypeString: null,       // enter a different doctype for older markup
      canvas: true,              // copy canvas content
      removeScripts: false,       // remove script tags from print content
      copyTagClasses: false,      // copy classes from the html & body tag
      beforePrintEvent: null,     // function for printEvent in iframe
      beforePrint: null,          // function called before iframe is filled
      afterPrint: null            // function called before iframe is removed
    });
  })
</script>

 <script>
        //print button
  //      function myFunction() {
    //      document.getElementById('printbtn').style.visibility = 'hidden';
    //      window.print();
    //    }
    </script>
@endsection
