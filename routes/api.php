

<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


// Route::controller(AuthController::class)->group(function(){

//     Route::post('/login', 'login');
//     Route::post('/register', 'register');
// });


Route::get('/register', [AuthController::class, 'index']);
Route::post('/register/save', [AuthController::class, 'register']);
Route::post('/login/save', [AuthController::class, 'login']);
// Route::post('/login/save', [AuthController::class, 'login']);
Route::post('/deleteUser', [AuthController::class, 'userDelete']);



Route::middleware('auth:sanctum')->prefix('/')->group(function () {
    Route::get('/employees', [EmployeeController::class, 'index']);
    Route::post('/save', [EmployeeController::class, 'store']);
    Route::put('/update/{id}', [EmployeeController::class, 'update']);
    Route::delete('/delete/{id}', [EmployeeController::class, 'delete']);
    Route::post('/logout', [AuthController::class, 'logOut']);
});







Route::get('/employees', [EmployeeController::class, 'index']);
Route::post('/save', [EmployeeController::class, 'store']);
Route::put('/update/{id}', [EmployeeController::class, 'update']);
Route::delete('/delete/{id}', [EmployeeController::class, 'delete']);