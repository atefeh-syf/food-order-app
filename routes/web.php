<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\FoodMenuController;
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