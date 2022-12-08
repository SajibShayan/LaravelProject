<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Models\Category;
use App\Models\User;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\DB;
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
//Email verification when we want to login
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');



Route::get('/', function () {
    return view('welcome');
});

//category controller

Route::get('/category/all', [CategoryController::class, 'AllCat'])->name('all.category');
Route::post('/category/add', [CategoryController::class, 'AddCat'])
->name('store.category')->middleware('categoryCheck');
Route::get('/category/edit/{id}', [CategoryController::class, 'Edit']);
Route::post('/category/update/{id}', [CategoryController::class, 'Update'])->middleware('categoryCheck');
Route::get('/softdelete/category/{id}', [CategoryController::class, 'SoftDelete']);
Route::get('/category/restore/{id}', [CategoryController::class, 'Restore']);
Route::get('/category/delete/{id}', [CategoryController::class, 'Delete']);

//For Brand
Route::get('/brand/all', [BrandController::class, 'AllBrand'])->name('all.brand');
Route::post('/brand/add', [BrandController::class, 'StoreBrand'])->name('store.brand')->middleware('AddBrandCheck');
Route::get('/brand/edit/{id}', [BrandController::class, 'Edit']);
Route::post('/brand/update/{id}', [BrandController::class, 'Update'])->middleware('AddBrandCheck');








Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {

       //$users = User::all();

       //$users = DB::table('users')->get();

        return view('admin.index');
       // return view('dashboard', ['users' => $users]);
    })->name('dashboard');
});

Route::get('/user/logout', [BrandController::class, 'userLogout'])->name('user.logout');





























// //Reset password
// Route::get('/forgot-password', function () {
//     return view('auth.forgot-password');
// })->middleware('guest')->name('password.store');



//Push from local repository Dec 8 2022//