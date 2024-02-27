<?php

use App\Http\Controllers\AdminControllers;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//php artisan serve
Route::get('/{name}', [AdminControllers::class, 'index']);
Route::get('/Administrator/login', [AdminControllers::class, 'login']);
Route::post('/Administrator/lg', [AdminControllers::class, 'loginuser']);
Route::post('/Administrator/search', [AdminControllers::class, 'searchinfouser']);
Route::get('/Administrator/search', [AdminControllers::class, 'searchinfouserget']);
Route::get('/Administrator/logoutadmin', [
    AdminControllers::class, 'logoutadmin'
]);

Route::get('/', function () {
    return view('welcome');
});