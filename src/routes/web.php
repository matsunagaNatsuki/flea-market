<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\RegisteredUserController;
Use App\Http\Requests\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

// 認証不要でアクセスできるルート
Route::get('/',[ItemController::class, 'index'])->name('items.list'); //商品一覧
Route::get('/item/{item}',[ItemController::class, 'detail'])->name('item.detail'); //商品詳細
Route::get('/item', [ItemController::class, 'search']); //検索機能

// ログインとメール認証が必要なルート
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/sell',[ItemController::class, 'sellView']);
    Route::post('/sell',[ItemController::class, 'sellCreate']);
    Route::post('/item/like/{item_id}',[LikeController::class,'create']);
    Route::post('item/unlike/{item_id}',[LikeController::class,'destroy']);
    Route::post('/item/comment/{item_id}',[CommentController::class,'create']);
    Route::get('/purchase/{item_id}',[PurchaseController::class,'index'])->middleware('purchase')->name('purchase.index');
    Route::post('/purchase/{item}',[PurchaseController::class,'purchase'])->middleware('purchase');
    Route::get('purchase/{item_id}/success',[PurchaseController::class,'success']);
    Route::get('/purchase/address/{item_id}',[PurchaseController::class, 'address']);
    Route::post('/purchase/address/{item_id}', [PurchaseController::class, 'updateAddress']);
    Route::get('/mypage', [UserController::class, 'mypage']);
    Route::get('/mypage/profile', [UserController::class,'profile']);
    Route::post('/mypage/profile',[UserController::class,'updateProfile']);
});

Route::post('login', [AuthenticatedSessionController::class, 'store'])->middleware('email');
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->name('verification.notice');

Route::post('/email/verification-notification', function (Request $request) {
    session()->get('unauthenticated_user')->sendEmailVerificationNotification();
    session()->put('resent', true);
    return back()->with('message', 'Verification link sent!');
})->name('verification.send');

Route::get('/email/verify/{id}/{hash}', function(EmailVerificationRequest $request) {
    $request->fulfill();
    session()->forget('unauthenticated_user');
    return redirect('/mypage/profile');
})->name('verification.verify');

Route::get('/stripe-test', function () {
    dd(class_exists(\Stripe\StripeClient::class));
});

