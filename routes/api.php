<?php

use App\Http\Controllers\API\ProductImageAPIController;
use App\Http\Controllers\PassportAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ProductAPIController;
use App\Http\Controllers\API\FilterListController;
use \App\Http\Controllers\API\IndexController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/register', [PassportAuthController::class, 'register']);
Route::post('/login', [PassportAuthController::class, 'login']);
Route::middleware('auth:api')->group(function () {
    Route::apiResources(['products_api' => ProductAPIController::class]);
});

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

//Route::get('/products', [ProductAPIController::class, 'index']);
//Route::post('/products', IndexController::class);
//Route::get('/products/filters', FilterListController::class);

Route::post('/product_image_api/{id}', [ProductImageAPIController::class, 'store'])->name('product_image_api.store');
Route::delete('/product_image_api/{id}', [ProductImageAPIController::class, 'destroy'])->name('product_image_api.destroy');

