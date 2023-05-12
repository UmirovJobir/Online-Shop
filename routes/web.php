<?php

use App\Http\Controllers\WEB\CategoryController;
use App\Http\Controllers\WEB\ColorController;
use App\Http\Controllers\WEB\ProductController;
use App\Http\Controllers\WEB\ProductImageController;
use App\Http\Controllers\WEB\TagController;
use App\Http\Controllers\WEB\UserController;
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


Route::post('/product_image/store', [ProductImageController::class, 'store'])->name('productimage.store');
Route::post('/product_image/update', [ProductImageController::class, 'update'])->name('productimage.update');

Route::get('/admin', App\Http\Controllers\Main\IndexController::class)->name('main.index');

Route::group(['prefix'=>'categories'], function (){
   Route::get('/',[CategoryController::class, 'index'])->name('category.index');

   Route::get('create',[CategoryController::class, 'create'])->name('category.create');
   Route::post('/',[CategoryController::class, 'store'])->name('category.store');
   Route::get('/show/{category}', [CategoryController::class, 'show'])->name('category.show');

   Route::get('{category}/edit',[CategoryController::class, 'edit'])->name('category.edit');
   Route::patch('{category}',[CategoryController::class, 'update'])->name('category.update');

   Route::delete('/{category}',[CategoryController::class, 'destroy'])->name('category.delete');
});

Route::resource('/tags', TagController::class);
Route::resource('/colors', ColorController::class);
Route::resource('/users', UserController::class);
Route::resource('/products', ProductController::class);

