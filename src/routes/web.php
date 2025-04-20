<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SellController;
use App\Http\Controllers\ProfileController;


Route::get('/?tab=mylist', [SellController::class, 'mylist']);
Route::get('/item/:item_id', [SellController::class, 'item']);
Route::post('/purchase/:item_id', [SellController::class,'purchase']);
Route::get('/purchase/:item_id', [SellController::class,'purchase']);
Route::get('/purchase/address/:item_id', [SellController::class,'updateAddress']);
Route::post('/purchase/address/:item_id', [SellController::class,'updateAddress']);
Route::get('/sell', [SellController::class, 'sell']);
Route::post('/sell', [SellController::class, 'sell']);
Route::post('/sell/:item_id/like', [SellController::class, 'like']);
Route::post('sell/:item_id/like', [SellController::class, 'comment']);
Route::get('/mypage', [ProfileController::class, 'mypage']);
Route::get('/mypage/profile', [ProfileController::class, 'edit_profile']);
Route::post('/mypage/profile', [ProfileController::class, 'edit_profile']);
Route::get('/mypage?tab=buy', [ProfileController::class, 'buyList']);
Route::get('/mypage?tab=sell', [ProfileController::class, 'sellList']);