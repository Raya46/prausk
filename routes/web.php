<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WalletController;
use Illuminate\Support\Facades\Route;

Route::get('/', [UserController::class, 'index']);
Route::get('/login', [UserController::class, 'getLogin']);
Route::post('/post-login', [UserController::class, 'postLogin']);
Route::post('/post-register', [UserController::class, 'postRegister']);
Route::post('/buy-now', [TransactionController::class, 'buyNow']);
Route::post('/add-to-cart', [TransactionController::class, 'addToCart']);
Route::put('/buy-from-cart', [TransactionController::class, 'buyFromCart']);
Route::delete('/cancel-cart/{id}', [TransactionController::class, 'cancelCart']);
Route::get('/register', [UserController::class, 'getRegister']);
Route::get('/logout', [UserController::class, 'logout']);
Route::get('/download-report/{order_code}', [TransactionController::class, 'downloadReport']);
Route::get('/download', [TransactionController::class, 'downloadAll']);
Route::get('/history', [TransactionController::class, 'history']);
Route::get('/cart', [TransactionController::class, 'cart']);

Route::post('/topup-user', [WalletController::class, 'topupUser']);
Route::post('/topup-bank', [WalletController::class, 'topupFromBank']);
Route::put('/topup-accept/{id}', [WalletController::class, 'topupAccept']);
Route::put('/withdraw-accept/{id}', [WalletController::class, 'withdrawAccept']);
Route::get('/list-topup', [WalletController::class, 'listTopup']);
Route::post('/withdraw-user', [WalletController::class, 'withdrawUser']);
Route::post('/withdraw-bank', [WalletController::class, 'withdrawBank']);

Route::post('/post-product', [ProductController::class, 'store']);
Route::put('/put-product/{id}', [ProductController::class, 'update']);
Route::delete('/destroy-product/{id}', [ProductController::class, 'destroy']);
Route::get('/transaksi-harian', [TransactionController::class, 'transaksiHarian']);
Route::get('/transaksi-harian/{date}', [TransactionController::class, 'downloadTransaksiHarian']);


