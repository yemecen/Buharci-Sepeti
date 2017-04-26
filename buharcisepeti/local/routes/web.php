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
Route::get('/', function () {
    return redirect('VapeSales');
});
Route::get('/AccessToken',['as'=>'AccessToken.index','uses'=>'PagesController@getIndex']);

Route::post('/AccessToken',['as'=>'AccessToken.post','uses'=>'PagesController@saveAccestoken']);

Route::get('/GroupLists',['as'=>'GroupLists.index','uses'=>'PagesController@getGroupListsIndex']);

Route::post('/GroupSales',['as'=>'GroupSales.post','uses'=>'PagesController@getGroupSalesIndex']);

Route::get('/VapeSales',['as'=>'VapeSales.index','uses'=>'PagesController@getVapeSalesIndex']);

Route::post('/VapeSalesSearch',['as'=>'VapeSalesSearch.post','uses'=>'PagesController@getVapeSalesSearch']);

//Route::post('/VapeSalesTwo',['as'=>'VapeSalesTwo.post','uses'=>'PagesController@getVapeSalesTwoSearch']);
//Route::get('/VapeSalesTwo',['as'=>'VapeSalesTwo.index','uses'=>'PagesController@getVapeSalesTwoIndex']);


