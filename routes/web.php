<?php
app()->singleton('owner', function () {
    if (auth()->user()->level_id) {
        return true;
    }
    return false;
});
//$2y$10$cOFBXLDro8y3c3Tan13ryeinVY3a42Ecy3oriwSZunBCJfOqMU/Ru
app()->singleton('store', function () {
});
app()->singleton('service', function () {
});
app()->singleton('sale', function () {
});
app()->singleton('tax', function () {
    return .14;
});


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('index');
//    return view('welcome');
//});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('index');
Route::get('/', 'HomeController@index')->name('index');
Route::get('/dashboardstore', 'SaleController@dashboard')->middleware('auth')->name('store.dashboard');
Route::get('/saleDate', 'SaleController@saleDate')->middleware('auth')->name('saleDate');

//stores

//Route::get('/store', 'StoreController@store')->name('store.store')->middleware('auth');
Route::get('/store', function(App\DataTables\Room_of_prdDataTable $dataTable) {
  return $dataTable->render('stores.store', [
      'stores' => \App\Room_of_prd::all(),
      'storeSum' => DB::table("products")->sum('cost') ,
      'storeSumAll' => DB::table('products')
                      ->join('room_of_prds', 'products.id', '=', 'room_of_prds.part_num_id')
                      ->select(DB::raw('sum((products.cost + (products.cost * 0.14)) * room_of_prds.quantity) AS total'))
                      ->get()
  ]);
})->name('store.store')->middleware('auth');
    Route::resource('sample', 'SampleController@index');
    Route::post('sample/export', 'SampleController@index');

//Route::get('/sale', 'SaleController@sale')->name('sale.sale')->middleware('auth');
Route::get('/sale', function(App\DataTables\Sales_fromDataTable $dataTable) {
  $salestax = DB::table("sales_froms")
  ->join('sales', 'sales_froms.sale_id', '=', 'sales.id')
  ->where('tax', 0)
  ->select(DB::raw('sum(sales_froms.price * sales_froms.quantity) AS total'))
    ->first();
$salex =  DB::table("sales_froms")
   ->join('sales', 'sales_froms.sale_id', '=', 'sales.id')
   ->where('tax', 1)
   ->select(DB::raw('sum((sales_froms.price + (sales_froms.price * 0.14)) * sales_froms.quantity) AS total'))
     ->first();
  return $dataTable->render('sales.sale', [
    'sale' => round($salestax->total + $salex->total,2)
        ]);
      })->name('sale.sale')->middleware('auth');
//Route::get('/purchases', 'BuyProductController@purchases')->name('purchases.purchases')->middleware('auth');
Route::get('/purchases', function(App\DataTables\BuyItemDataTable $dataTable) {
  $buytax = DB::table("buy_items")
  ->join('buy_products', 'buy_items.buy_product_id', '=', 'buy_products.id')
  ->where('tax', 0)
  ->select(DB::raw('sum(buy_items.price  * buy_items.quantity) AS total'))
    ->first();
$buyntx =  DB::table("buy_items")
   ->join('buy_products', 'buy_items.buy_product_id', '=', 'buy_products.id')
   ->where('tax', 1)
   ->select(DB::raw('sum((buy_items.price + (buy_items.price * 0.14)) * buy_items.quantity) AS total'))
     ->first();
  return $dataTable->render('sales.showbuy', [
    'purchasesSum' => round($buytax->total + $buyntx->total,2)
        ]);
      })->name('purchases.purchases')->middleware('auth');

//Route::get('/card', 'CardController@card')->name('card.card')->middleware('auth');
Route::get('/card', function(App\DataTables\CardDataTable $dataTable) {
  return $dataTable->render('sales.card');
      })->name('card.card')->middleware('auth');

Route::get('/type/add', 'ProductTypeController@index')->name('type.add')->middleware('auth');
Route::post('/type/add', 'ProductTypeController@store')->name('type.add')->middleware('auth');

Route::get('/brand/add', 'BrandController@addBrand')->name('brand.add')->middleware('auth');
Route::post('/brand/add', 'BrandController@addBrand')->name('brand.add')->middleware('auth');

Route::get('/description/add', 'DescriptionController@addDec')->name('dec.add')->middleware('auth');
Route::post('/description/add', 'DescriptionController@addDec')->name('dec.add')->middleware('auth');

Route::get('/auth/add', 'AauthController@addAuth')->name('auth.add')->middleware('auth');
Route::post('/auth/add', 'AauthController@addAuth')->name('auth.add')->middleware('auth');

Route::get('/product/add', 'ProductController@addProduct')->name('product.add')->middleware('auth');
Route::post('/product/add', 'ProductController@addProduct')->name('product.add')->middleware('auth');

Route::get('/updateProduct/{id}', 'ProductController@update')->name('prodct.updatePage')->middleware('auth');
Route::put('/updateProduct/{id}', 'ProductController@updateProduct')->name('updateProduct')->middleware('auth');

Route::get('/sale/add', 'SaleController@addSale')->name('sale.add.get')->middleware('auth');
Route::post('/sale/add', 'SaleController@addSale')->name('sale.add.post')->middleware('auth');
Route::get('/sale/part', 'SaleController@partNum')->name('partNum')->middleware('auth');
Route::get('/sale/delete/{id}', 'SaleController@delete')->name('deleteSale')->middleware('auth');

Route::get('/supplier/add', 'SuppliersController@addSupplier')->name('supplier.add.get')->middleware('auth');
Route::post('/supplier/add', 'SuppliersController@addSupplier')->name('supplier.add.post')->middleware('auth');
Route::get('/supplierTable', 'SuppliersController@show')->name('supplierTable')->middleware('auth');
Route::get('/supplierUpdate/{id}', 'SuppliersController@supplierUpdatePage')->name('supplierUpdatePage')->middleware('auth');
Route::put('/supplierUpdate/{id}', 'SuppliersController@update')->name('supplierUpdate')->middleware('auth');
Route::get('/supplierDelete/{id}', 'SuppliersController@SoftDelete')->name('supplierDelete')->middleware('auth');



Route::get('/customer/add', 'CustomerController@index')->name('customer.index')->middleware('auth');
Route::post('/customer/add', 'CustomerController@store')->name('customer.store')->middleware('auth');
Route::get('/customerTable', 'CustomerController@show')->name('customerTable')->middleware('auth');
Route::get('/deleteCustomer/{id}', 'CustomerController@SoftDelete')->name('deleteCustomer')->middleware('auth');
Route::get('/customerUpdate/{id}', 'CustomerController@customerUpdatePage')->name('customerUpdatePage')->middleware('auth');
Route::put('/customerUpdate/{id}', 'CustomerController@update')->name('customerUpdate')->middleware('auth');

Route::get('/salesMen/add', 'SalesMenController@index')->name('salesMen.index')->middleware('auth');
Route::post('/salesMen/add', 'SalesMenController@store')->name('salesMen.store')->middleware('auth');

Route::get('/buy/add', 'BuyProductController@addBuy')->name('buy.add.get')->middleware('auth');
Route::post('/buy/add', 'BuyProductController@addBuy')->name('buy.add.post')->middleware('auth');


Route::get('/buy/delete/{id}', 'BuyProductController@delete')->name('deleteBuy')->middleware('auth');
Route::delete('/buy/delete/{id}', 'BuyProductController@delete')->name('deleteBuy')->middleware('auth');


Route::get('/store/add', 'StoreController@addStore')->name('store.add.get')->middleware('auth');
Route::post('/store/add', 'StoreController@addStore')->name('store.add.post')->middleware('auth');

Route::get('/store/delete/{id}', 'StoreController@deleteStore')->name('store.delete.get')->middleware('auth');


Route::get('/room/add/{id}', 'RoomController@addRoom')->name('room.add.get')->middleware('auth');
Route::post('/room/add/{id}', 'RoomController@addRoom')->name('room.add.post')->middleware('auth');

Route::get('/room/delete/{id}', 'RoomController@deleteRoom')->name('room.delete.get')->middleware('auth');
Route::get('/roomofprd/delete/{id}', 'RoomController@deleteRoomOfPrd')->name('roomofprd.delete.get')->middleware('auth');

Route::get('/room/edit/{id}', 'RoomController@editRoom')->name('room.edit.get')->middleware('auth');
Route::post('/room/edit/{id}', 'RoomController@editRoom')->name('room.edit.post')->middleware('auth');

Route::get('/quantity/edit/{id}', 'RoomController@editQuantity')->name('quantity.edit.get')->middleware('auth');
Route::post('/quantity/edit/{id}', 'RoomController@editQuantity')->name('quantity.edit.post')->middleware('auth');

Route::post('/autoCompleteBrand', 'ProductController@autoCompleteBrand')->name('autoCompleteBrand')->middleware('auth');

//Service
//add machine informations

Route::get('/addMachine', 'MachineInformationController@index')->name('addMachine.index')->middleware('auth');
Route::post('/addMachine', 'MachineInformationController@store')->name('addMachine.store')->middleware('auth');
// machine informations table
Route::get('/machinetable', function(App\DataTables\MachineInformationDataTable $dataTable) {
    return $dataTable->render('service.machinetable');
})->name('machineInfo.table')->middleware('auth');

//Route::get('/machinetable', 'MachineInformationController@table')->name('machineInfo.table')->middleware('auth');
Route::post('/addMachine', 'MachineInformationController@store')->name('addMachine.store')->middleware('auth');
Route::get('/machineUpdate/{id}', 'MachineInformationController@updatePage')->name('updatePage')->middleware('auth');
Route::put('/machineUpdate/{id}', 'MachineInformationController@updateMachine')->name('updateMachine')->middleware('auth');

Route::get('/machineReports/{id}', 'MachineInformationController@machineReports')->name('machineReports')->middleware('auth');

//add call
Route::get('/addCall', 'CallController@index')->name('addCall.index')->middleware('auth');
Route::post('/addCall', 'CallController@store')->name('addCall.store')->middleware('auth');

Route::get('/call/delete/{id}', 'CallController@delete')->name('deleteCall')->middleware('auth');
Route::delete('/call/delete/{id}', 'CallController@delete')->name('deleteCall')->middleware('auth');

Route::get('/uncompletedCall', 'CallController@uncompleted')->name('uncompletedCall')->middleware('auth');

// engineers
Route::get('/addEngineers', 'EngineersController@index')->name('addEngineers.index')->middleware('auth');
Route::post('/addEngineers', 'EngineersController@store')->name('addEngineers.store')->middleware('auth');
Route::get('/showEngineer', 'EngineersController@show')->name('showEngineerTable')->middleware('auth');

Route::get('/deleteEngineer/{id}', 'EngineersController@SoftDelete')->name('deleteEngineer')->middleware('auth');

Route::get('/engineerUpdate/{id}', 'EngineersController@engineerUpdatePage')->name('engineerUpdatePage')->middleware('auth');
Route::put('/engineerUpdate/{id}', 'EngineersController@update')->name('engineerUpdate')->middleware('auth');

Route::get('/showEngineerStock/{id}', 'EngineerProductController@index')->name('showEngineerStock')->middleware('auth');
Route::get('/addEngineerStock/{id}', 'EngineerProductController@addStock')->name('addEngineersStock')->middleware('auth');
Route::post('/addEngineerStock/{id}', 'EngineerProductController@store')->name('storeEngineersStock')->middleware('auth');
Route::put('/editeEngineerStock/{eng_id}/{prd_id}', 'EngineerProductController@edite')->name('editeEngineersStock')->middleware('auth');
Route::delete('/deleteEngineerStock/{eng_id}/{prd_id}', 'EngineerProductController@destroy')->name('deleteEngineersStock')->middleware('auth');

//call table
//Route::get('/callTable', 'CallController@callTable')->name('callTable')->middleware('auth');
// data table call table ajax]

Route::get('/callTable', function(App\DataTables\CallDataTable $dataTable) {
    return $dataTable->render('service.callTable');
})->name('callTable')->middleware('auth');

Route::get('/ServiceReportTable', function(App\DataTables\ServiceReportDataTable $dataTable) {
    return $dataTable->render('service.ServiceReportTable');
})->name('ServiceReportTable')->middleware('auth');

//Route::get('/calldatatable', 'CallController@callDataTable')->name('call.datatable')->middleware('auth');
//report
//Route::get('call/{call}/reports','ServiceReportController@viewReport')->name('viewReport')->middleware('auth');;

Route::get('/addReport/{call}/{eng}', 'ServiceReportController@index')->name('addReport')->middleware('auth');
Route::post('/addReport/{call}/{eng}', 'ServiceReportController@store')->name('saveReport')->middleware('auth');
Route::get('/viewReport/{call}', 'ServiceReportController@viewReport')->name('viewReport')->middleware('auth');
Route::get('/printReport/{call}', 'ServiceReportController@printReport')->name('printReport')->middleware('auth');

Route::get('/chooseEnginner/{call}', 'ServiceReportController@choose')->name('chooseEnginner')->middleware('auth');

//searches
// product search
Route::post('/search', 'StoreController@search')->name('Store.search')->middleware('auth');

//ajax
Route::get('/allprd', function () {
    return \App\Product::all();
})->name('allprd')->middleware('auth');


//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/ajax1', function () {
    return view('ajax');
})->middleware('sale');
Route::post('/ajax2', function () {
    if (request()->ajax()) {
//        return 'text';
        return request();
        return request('text');
//        return response(\App\User::all(),['done']);
    }
})->middleware('sale');
