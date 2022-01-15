<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\FoodMenuController;
use App\Http\Controllers\Admin\FoodController;
use App\Http\Controllers\Admin\FoodImageController;
use App\Http\Controllers\general\FoodController as generalFoodController;
use App\Http\Controllers\general\FoodMenuController as generalFoodMenuController;
use App\Http\Controllers\general\CartController;
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

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix'  =>   'food_menus'], function() {
    Route::get('/', [FoodMenuController::class, 'index'])->name('admin.foodmenus.index');
    Route::get('/create', [FoodMenuController::class, 'create'])->name('admin.foodmenus.create');
    Route::post('/store', [FoodMenuController::class, 'store'])->name('admin.foodmenus.store');
    Route::get('/{id}/edit', [FoodMenuController::class, 'edit'])->name('admin.foodmenus.edit');
    Route::post('/update', [FoodMenuController::class, 'update'])->name('admin.foodmenus.update');
    Route::get('/{id}/delete', [FoodMenuController::class, 'delete'])->name('admin.foodmenus.delete');
});

Route::group(['prefix' => 'foods'], function () {
    Route::get('/', [FoodController::class, 'index'])->name('admin.foods.index');
    Route::get('/create', [FoodController::class, 'create'])->name('admin.foods.create');
    Route::post('/store', [FoodController::class, 'store'])->name('admin.foods.store');
    Route::get('/edit/{id}', [FoodController::class, 'edit'])->name('admin.foods.edit');
    Route::post('/update', [FoodController::class, 'delete'])->name('admin.foods.update');

    Route::post('images/upload', [FoodImageController::class, 'upload'])->name('admin.foods.images.upload');
    Route::get('images/{id}/delete', [FoodImageController::class, 'delete'])->name('admin.foods.images.delete');
 });

 Route::get('/food_menu/{id}', [generalFoodMenuController::class, 'show'])->name('foodmenu.show');
 Route::get('/food/{id}', [generalFoodController::class, 'show'])->name('food.show');
 
 Route::post('/food/add/cart', [generalFoodController::class, 'addToCart'])->name('food.add.cart');
 Route::get('/cart', [CartController::class, 'getCart'])->name('checkout.cart');
 Route::get('/cart/item/{id}/remove', [CartController::class, 'removeItem'])->name('checkout.cart.remove');
 Route::get('/cart/clear', [CartController::class, 'clearCart'])->name('checkout.cart.clear');
 
 
Route::view('/', 'general.pages.homepage');
Route::group(['middleware' => ['auth']], function () {
    Route::get('/checkout', 'Site\CheckoutController@getCheckout')->name('checkout.index');
    Route::post('/checkout/order', 'Site\CheckoutController@placeOrder')->name('checkout.place.order');

    Route::get('checkout/payment/complete', 'Site\CheckoutController@complete')->name('checkout.payment.complete');

    Route::get('account/orders', 'Site\AccountController@getOrders')->name('account.orders');
});
