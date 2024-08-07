<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/products', [ProductController::class, 'index']); 
Route::get('/products/{id}', [ProductController::class, 'show']); 
Route::post('/products', [ProductController::class, 'store']); 
Route::put('/products/{id}', [ProductController::class, 'update']);
Route::delete('/api/products/{id}', [ProductController::class, 'destroy']);

Route::apiResource('customers', CustomerController::class);

Route::get('/users', [UserController::class, 'index']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);

Route::get('/orders', [OrderController::class, 'index']);


Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [LoginController::class, 'login']);

use App\Http\Controllers\CakeController;

Route::get('/cakes', [CakeController::class, 'index']);

use App\Http\Controllers\CookieController;

Route::get('/cookies', [CookieController::class, 'index']);


use App\Http\Controllers\CoffeeController;
Route::get('/coffees', [CoffeeController::class, 'index']);

