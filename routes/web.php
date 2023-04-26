<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

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


Route::get('/', App\Http\Controllers\Main\IndexController::class)->name('main.index');

Route::group(['prefix'=>'categories'], function (){
   Route::get('/',[CategoryController::class, 'index'])->name('category.index');

   Route::get('create',[CategoryController::class, 'create'])->name('category.create');
   Route::post('/',[CategoryController::class, 'store'])->name('category.store');
   Route::get('/show/{category}', [CategoryController::class, 'show'])->name('category.show');

   Route::get('{category}/edit',[CategoryController::class, 'edit'])->name('category.edit');
   Route::patch('{category}',[CategoryController::class, 'update'])->name('category.update');

   Route::delete('/{category}',[CategoryController::class, 'delete'])->name('category.delete');
});

