<?php

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
/*

Route::get('/addAdmin',['as'=>'sdm2.addAdmin','uses'=>'ItemController@index']); 


Route::get('/', function () {
    return view('welcome');
});
*/


Route::get('/',['as'=>'sdm2.info','uses'=>'Sdm2Controller@info']); 



Route::get('/addDevice',['as'=>'sdm2.index','uses'=>'StockController@start']); 
Route::post('/addDevice',['as'=>'sdm2.store','uses'=>'StockController@store']);


Route::get('/checkbill',['as'=>'sdm2.checkbill','uses'=>'BillrequestController@checkbill']); 


Route::get('/listItem',['as'=>'sdm2.listItem','uses'=>'StockController@index']); 
Route::post('/listItem',['as'=>'sdm2.show','uses'=>'StockController@show']);

Route::get('/requestitem',['as'=>'sdm2.requestitem','uses'=>'StockController@index2']); 





Route::post('/requestListItem',['as'=>'sdm2.submitITEM','uses'=>'RequestItemController@submitITEM']);

Route::get('/billrequest',['as'=>'sdm2.billrequest','uses'=>'BillrequestController@index']); 

Route::post('/yesBillRequest',['as'=>'sdm2.yesBillRequest','uses'=>'BillrequestController@yesBillRequest']);
Route::post('/NoBillRequest',['as'=>'sdm2.NoBillRequest','uses'=>'BillrequestController@NoBillRequest']);

Route::post('/yeslistuser',['as'=>'sdm2.yeslistuser','uses'=>'UsersController@yeslistuser']);
Route::post('/Nolistuser',['as'=>'sdm2.Nolistuser','uses'=>'UsersController@Nolistuser']);


Route::get('/historybill',['as'=>'sdm2.historybill','uses'=>'BillrequestController@historybill']);
Route::post('/historybill',['as'=>'sdm2.historybillyear','uses'=>'BillrequestController@historybillyear']);

Route::post('/formprint',['as'=>'pdf.formprint','uses'=>'PdfController@formprint']);
Route::post('/formprintbill',['as'=>'pdf.formprintbill','uses'=>'PdfController@formprintbill']);

Route::post('/formprintdevice',['as'=>'pdf.formprintdevice','uses'=>'PdfController@formprintdevice']);
Route::post('/formprintgraph',['as'=>'pdf.formprintgraph','uses'=>'PdfController@formprintgraph']);

Route::get('/login',['as'=>'sdm2.login','uses'=>'UsersController@login']); 
Route::post('/login',['as'=>'sdm2.getloginuser','uses'=>'UsersController@getloginuser']);




Route::get('/loginadmin',['as'=>'sdm2.loginadmin','uses'=>'UsersController@loginadmin']); 
Route::post('/loginadmin',['as'=>'sdm2.getloginaddmin','uses'=>'UsersController@getloginaddmin']);

Route::get('/loginadmin',['as'=>'sdm2.loginadmin','uses'=>'UsersController@loginadmin']); 
Route::get('/logout',['as'=>'sdm2.logout','uses'=>'UsersController@logout']);


Route::get('/requestuser',['as'=>'sdm2.requestuser','uses'=>'UsersController@requestuser']);
Route::get('/listuser',['as'=>'sdm2.listuser','uses'=>'UsersController@listuser']);

Route::post('/createuser',['as'=>'sdm2.createuser','uses'=>'UsersController@createuser']);

Route::post('/seting_pass',['as'=>'sdm2.seting_pass','uses'=>'UsersController@seting_pass']);
Route::post('/submitEditProfile',['as'=>'sdm2.submitEditProfile','uses'=>'UsersController@submitEditProfile']);


Route::post('/editDevice',['as'=>'sdm2.editDevice','uses'=>'StockController@editDevice']);
Route::post('/updateDevice',['as'=>'sdm2.updateDevice','uses'=>'StockController@updateDevice']);


Route::post('/updateProfile',['as'=>'sdm2.updateProfile','uses'=>'UsersController@updateProfile']);

Route::get('/requestadmin',['as'=>'sdm2.requestadmin','uses'=>'UsersController@requestadmin']);

Route::post('/createadmin',['as'=>'sdm2.createadmin','uses'=>'UsersController@createadmin']);


Route::get('/listadmin',['as'=>'sdm2.listadmin','uses'=>'UsersController@listadmin']);


Route::post('/exportHighRequest',['as'=>'excel.exportHighRequest','uses'=>'ExcelController@exportHighRequest']);
Route::get('/exportHighRequest',['as'=>'excel.exportHighRequest','uses'=>'ExcelController@exportHighRequest']);

Route::post('/exportDeviceAll',['as'=>'excel.exportDeviceAll','uses'=>'ExcelController@exportDeviceAll']);

