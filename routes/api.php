<?php

use Illuminate\Http\Request;
use App\Http\Controllers\API\AuthController;
use Illuminate\Support\Facades\Route;



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

});



Route::middleware(['auth:sanctum'])->group(function () {

    Route::post('logout', [AuthController::class, 'logout']);

});





// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
