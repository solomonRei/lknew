<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\UserProfileController2;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

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
    return redirect()->route('auth.index');
})->name('main');


Route::get('/language/{lang}', function ($lang) {
    Session::put('locale', $lang);
    return back();
})->name('change_language');


Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('auth.index');
    Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
    Route::get('/complete-registration', [AuthController::class, 'completeRegistration'])->name('complete.registration');
    Route::post('/2fa', [AuthController::class, 'verifyOTP'])->name('2fa');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [UserProfileController::class, 'showUserProfile'])->name('profile');
    Route::get('/profile/edit', [UserProfileController::class, 'showEditUserProfile'])->name('user.editProfile');
    Route::post('/profile/add-phone', [UserProfileController::class, 'addPhone'])->name('user.addPhone');
    Route::post('/profile/add-address', [UserProfileController::class, 'addAddress'])->name('user.addAddress');
    Route::post('/profile/phone/{phoneId}/update', [UserProfileController::class, 'updatePhone'])->name('user.editPhone');
    Route::delete('/profile/phone/{phoneId}/delete', [UserProfileController::class, 'deletePhone'])->name('user.deletePhone');

    Route::get('/profile/address/{addressId}/edit', [UserProfileController::class, 'editAddress'])->name('profile.editAddress');
    Route::post('/profile/address/{addressId}/update', [UserProfileController::class, 'updateAddress'])->name('profile.updateAddress');
    Route::delete('/profile/address/{addressId}/delete', [UserProfileController::class, 'deleteAddress'])->name('profile.deleteAddress');

    Route::post('/user/change-password', [UserController::class, 'changePassword'])->name('user.changePassword');
    Route::post('/user/photo', [UserProfileController::class, 'updateAvatar'])->name('user.avatarUpdate');
    Route::post('/user/update', [UserProfileController::class, 'updateProfile'])->name('user.profileUpdate');



    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
    Route::get('/orders/edit/{orderId}', [OrderController::class, 'edit'])->name('orders.edit');
    Route::post('/order/store', [OrderController::class, 'storeItem'])->name('orders.storeItem');
    Route::get('/order/{orderId}/items', [OrderController::class, 'getOrderItems'])->name('orders.getItems');
    Route::post('/orders/complete', [OrderController::class, 'completeOrder'])->name('orders.complete');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('order.show');
    Route::get('/orders/{order}/export', [OrderController::class, 'export'])->name('orders.export');
    Route::post('/order/item/{itemId}/update', [OrderController::class, 'updateItem'])->name('orders.updateItem');
    Route::delete('/order-item/{itemId}/delete', [OrderController::class, 'deleteItem'])->name('order.item.delete');
    Route::get('/order/search', [OrderController::class, 'search'])->name('order.search');

//    Route::get('/profile', [UserProfileController::class, 'index'])->name('profile.index');
//    Route::post('/profile', [UserProfileController::class, 'update'])->name('profile.update');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/item/get/{itemId}', [OrderController::class, 'getItem'])->name('item.get');
//
//    Route::get('/orders', function () {
//        return view('front.orders');
//    })->name('orders');
//
});
