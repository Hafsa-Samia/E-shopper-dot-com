<?php

use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


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
    return view('try');
});


//Authenticated Area
Route::get('login', [CustomAuthController::class, 'login'])->name('login');
Route::get('registration', [CustomAuthController::class, 'registration'])->name('registration');
Route::post('register-user', [CustomAuthController::class, 'registerUser'])->name('register-user');
Route::post('login-user', [CustomAuthController::class, 'loginUser'])->name('login-user');
Route::get('dashboard', [CustomAuthController::class, 'dashboard'])->name('dashboard');
Route::get('logout', [CustomAuthController::class, 'logout'])->name('logout');



Route::get('detail/{id}', [ProductController::class, 'detail'])->name('detail');

Route::post('add_to_cart', [ProductController::class, 'addToCart'])->name('add_to_cart')
    ->middleware('isLoggedIn');

Route::get('cartlist',[ProductController::class,'cartList'])->name('cartlist');
Route::get('cart.remove/{id}',[ProductController::class,'cartRemove'])->name('remove_cart_item');
Route::get('order',[ProductController::class,'orderNow'])->name('make_order');
Route::post('orderplace',[ProductController::class,'orderPlace'])->name('orderplace');
Route::get('userorders',[ProductController::class,'userOrders'])->name('user_orders');

Route::get('search',[ProductController::class,'searchProduct'])->name('search');




// Authenticated area
// Route::group(['middleware' => ['isLoggedIn']], function () {
//     Route::post('add_to_cart', [ProductController::class, 'addToCart'])->name('add_to_cart');
// });

// Route::middleware(['isLoggedIn'], function () {
//     Route::post('add_to_cart', [ProductController::class, 'addToCart'])->name('add_to_cart');
// });
