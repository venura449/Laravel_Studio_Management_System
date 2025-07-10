<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use \App\Http\Controllers\ItemController;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//User Routes

Route::get('/user/manage', [UserController::class, 'index'])->name('user.manage');
Route::post('/user/edit/{userId}', [UserController::class, 'update'])->name('user.edit');
Route::post('/user/delete/{userId}',[ UserController::class, 'delete'])->name('user.delete');

//Order Routes
Route::get('/order/create', [OrderController::class, 'index'])->name('order.create');
Route::post('/order/add', [OrderController::class, 'store'])->name('order.add');
Route::get('/order/view', [OrderController::class, 'view'])->name('order.view');
Route::get('/order/vieweach/{orderId}', [OrderController::class, 'vieweach'])->name('order.vieweach');
Route::post('/order/delete/{orderId}', [OrderController::class, 'delete'])->name('order.delete');
Route::get('/order/editform/{orderId}', [OrderController::class, 'updateform'])->name('order.edit');
Route::post('/order/update/{orderId}', [OrderController::class, 'update'])->name('order.update');

//additional Route

Route::get('/order/realpay/{orderId}', [OrderController::class, 'realpay'])->name('item.realpay');
Route::get('/order/laterrealpay/{orderId}', [OrderController::class, 'laterpay'])->name('item.laterrealpay');


//Item Routes
Route::get('/item/View', [ItemController::class, 'index'])->name('item.view');
Route::get('/item/Vieweach/{itemId}', [ItemController::class, 'vieweach'])->name('item.vieweach');
Route::post('/item/delete/{itemId}', [ItemController::class, 'delete'])->name('item.delete');
Route::post('/item/update/{itemId}', [ItemController::class, 'edit'])->name('item.update');
Route::get('/item/create', [ItemController::class, 'create'])->name('item.create');
Route::post('/item/store', [ItemController::class, 'store'])->name('item.store');
Route::get('/item/json', [App\Http\Controllers\ItemController::class, 'getAllJson'])->name('item.json');

//payment Routes
Route::get('/pay/view', [OrderController::class, 'renderfinalpay'])->name('pay.view');
Route::get('/order/printbill/{orderId}', [OrderController::class, 'printBill'])->name('order.printbill');
Route::get('/pay/paynow/{orderId}', [OrderController::class, 'changepay'])->name('pay.paynow');
Route::get('/pay/paylater/{orderId}', [OrderController::class, 'changeunpaid'])->name('pay.paylater');
Route::get('/pay/unpaidview', [OrderController::class, 'unpaidView'])->name('pay.unpaidview');
Route::get('/pay/paidview', [OrderController::class, 'paidView'])->name('pay.paidview');
Route::get('/pay/paid/{orderId}', [OrderController::class, 'paid'])->name('pay.paid');


