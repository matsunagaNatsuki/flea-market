<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SellController;
use App\Http\Controllers\ProfileController;

Route::get('/',[SellController::class, 'index']);
Route::get('/?tab=myList', [SellController::class, 'myList']);
Route::get('/item/{item_id}', [SellController::class, 'item']);
Route::post('/purchase/{item_id}', [SellController::class,'purchase']);
Route::get('/purchase/{item_id}', [SellController::class,'purchase']);
Route::get('/purchase/address/{item_id}', [SellController::class,'address']);
Route::post('/purchase/address/{item_id}', [SellController::class,'address']);
Route::get('/sell', [SellController::class, 'sell']);
Route::post('/sell', [SellController::class, 'sell']);
Route::post('/sell/:item_id/like', [SellController::class, 'like']);
Route::post('sell/:item_id/like', [SellController::class, 'comment']);
Route::get('/mypage', [ProfileController::class, 'mypage']);
Route::get('/mypage/profile', [ProfileController::class, 'showProfile']);
Route::post('/mypage/profile', [ProfileController::class, 'editProfile']);
Route::get('/mypage?tab=buy', [ProfileController::class, 'buyList']);
Route::get('/mypage?tab=sell', [ProfileController::class, 'sellList']);