<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ProductController;



// PUBLIC ROUTES
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);



// PROTECTED ROUTES
Route::group(['middleware' => ['auth:sanctum']], function () {
    // Route::post('/products', [ProductController::class, 'store']);
    // Route::put('/products/{$id}', [ProductController::class, 'update']);
    // Route::delete('/products/{$id}', [ProductController::class, 'destroy']);
    Route::post('logout', [AuthController::class, 'logout']);
});


Route::middleware(['auth:sanctum', 'isAPIAdmin'])->group(function () {
    Route::get('/checkAuthenticated', function () {
        return response()->json(['message' => 'You are in', 'status' => 200], 200);
    });

    //Category
    Route::get('view-category', [CategoryController::class, 'index']);
    Route::get('all-category', [CategoryController::class, 'allcategory']);
    Route::post('store-category', [CategoryController::class, 'store']);
    Route::get('edit-category/{id}', [CategoryController::class, 'edit']);
    Route::put('update-category/{id}', [CategoryController::class, 'update']);
    Route::delete('delete-category/{id}', [CategoryController::class, 'destroy']);



     //Product
     Route::get('view-product', [ProductController::class, 'index']);
    //  Route::get('all-category', [CategoryController::class, 'allcategory']);
     Route::post('store-product', [ProductController::class, 'store']);
     Route::get('edit-product/{id}', [ProductController::class, 'edit']);
     Route::post('update-product/{id}', [ProductController::class, 'update']);
    //  Route::delete('delete-category/{id}', [CategoryController::class, 'destroy']);










});



Route::middleware(['auth:sanctum'])->group(function () {

    Route::post('logout', [AuthController::class, 'logout']);

});





// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
