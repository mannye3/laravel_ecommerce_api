<?php

use Illuminate\Http\Request;
use App\Http\Controllers\API\AuthController;
use Illuminate\Support\Facades\Route;



// PUBLIC ROUTES
// Route::resource('products', ProductController::class);
// Route::get('/products', [ProductController::class, 'index']);
// Route::get('/products/{$id}', [ProductController::class, 'show']);
// Route::get('/products/search/{name}', [ProductController::class, 'search']);
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);


// PROTECTED ROUTES
Route::group(['middleware' => ['auth:sanctum']], function () {
    // Route::post('/products', [ProductController::class, 'store']);
    // Route::put('/products/{$id}', [ProductController::class, 'update']);
    // Route::delete('/products/{$id}', [ProductController::class, 'destroy']);
    Route::post('logout', [AuthController::class, 'logout']);
});




Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
