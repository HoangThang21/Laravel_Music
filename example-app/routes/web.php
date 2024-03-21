<?php

use App\Http\Controllers\AdminControllers;
use App\Http\Controllers\ClientControllers;
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
//$2y$12$NtkJdK.h29/F05ng2LhENene/YJ23pPBRNWZShESdFQ0PvBhHCVyO
Route::get('/Administrator', [AdminControllers::class, 'index']);
Route::get('/Administrator/login', [AdminControllers::class, 'login']);
Route::post('/Administrator/lg', [AdminControllers::class, 'loginuser']);
Route::post('/Administrator/search', [AdminControllers::class, 'searchinfouser']);
Route::post('/Administrator/themnd', [AdminControllers::class, 'themnd']);
Route::post('/Administrator/doimatkhaund', [AdminControllers::class, 'doimatkhaund']);
Route::post('/Administrator/suanguoidungbt', [AdminControllers::class, 'suanguoidungbt']);
Route::get('/Administrator/hoso', [AdminControllers::class, 'hoso']);
Route::get('/Administrator/doimatkhau', [AdminControllers::class, 'doimatkhau']);
Route::put('/Administrator/suand', [AdminControllers::class, 'suand']);
Route::get('/Administrator/logoutadmin', [
    AdminControllers::class, 'logoutadmin'
]);
Route::get('/Administrator/themnguoidung', [AdminControllers::class, 'themnguoidung']);
Route::post('/Administrator/sendmail', [AdminControllers::class, 'sendmail']);
//----------------------------------------------------------------
//Form The loai
Route::get('/Administrator/qltheloai', [
    AdminControllers::class, 'qltheloai'
]);
Route::post('/Administrator/themtl', [AdminControllers::class, 'themtl']);
Route::put('/Administrator/qltheloai/suatheloai', [AdminControllers::class, 'suatheloai']);
Route::get('/Administrator/qltheloai/themtheloai', [AdminControllers::class, 'themtheloai']);
Route::get('/Administrator/qltheloai/suatheloai&{id}', [
    AdminControllers::class, 'formchuyensua'
]);
Route::get('/Administrator/qltheloai/xoatheloai&{id}', [
    AdminControllers::class, 'destroy'
]);
//----------------------------------------------------------------
//FormNghesi
Route::get('/Administrator/qlnghesi', [
    AdminControllers::class, 'qlnghesi'
]);
Route::get('/Administrator/qlnghesi/themnghesi', [
    AdminControllers::class, 'themnghesi'
]);
Route::get('/Administrator/qlnghesi/suggest-data', [
    AdminControllers::class, 'suggestData'
]);
Route::post('/Administrator/qlnghesi/themns', [
    AdminControllers::class, 'themns'
]);
Route::put('/Administrator/qlnghesi/suanghesi', [
    AdminControllers::class, 'suanghesi'
]);
Route::get('/Administrator/qlnghesi/xoanghesi&{id}', [
    AdminControllers::class, 'destroy'
]);
Route::get('/Administrator/qlnghesi/{name}&{number}-{type}', [
    AdminControllers::class, 'qlupdate'
]);
Route::post('/Administrator/qlnghesi/searchns', [AdminControllers::class, 'searchns']);

//----------------------------------------------------------------
//FormAlbum
Route::get('/Administrator/qlalbum', [
    AdminControllers::class, 'qlalbum'
]);
Route::get('/Administrator/qlalbum/themalbum', [
    AdminControllers::class, 'themalbum'
]);
Route::post('/Administrator/qlalbum/themalb', [
    AdminControllers::class, 'themalb'
]);
Route::put('/Administrator/qlalbum/suaalbum', [
    AdminControllers::class, 'suaalbum'
]);
Route::get('/Administrator/qlalbum/xoaalbum&{id}', [
    AdminControllers::class, 'destroy'
]);
Route::get('/Administrator/qlalbum/{name}&{number}-{type}', [
    AdminControllers::class, 'qlupdate'
]);
Route::post('/Administrator/qlalbum/searchal', [AdminControllers::class, 'searchal']);

//----------------------------------------------------------------
//Form nhac
Route::get('/Administrator/qlnhac', [AdminControllers::class, 'qlnhac']);
Route::get('/Administrator/qlnhac/themnhac', [AdminControllers::class, 'themnhac']);
Route::post('/Administrator/qlnhac/themmusic', [AdminControllers::class, 'themmusic']);
Route::put('/Administrator/qlnhac/suanhac', [AdminControllers::class, 'suanhac']);
Route::get('/Administrator/qlnhac/xoanhac&{id}', [
    AdminControllers::class, 'destroy'
]);
Route::get('/Administrator/qlnhac/{name}&{number}-{type}', [
    AdminControllers::class, 'qlupdate'
]);
Route::post('/Administrator/qlnhac/searchs', [AdminControllers::class, 'searchs']);
//----------------------------------------------------------------
Route::get('/Administrator/{id}', [AdminControllers::class, 'edit']);
Route::get('/', [ClientControllers::class, 'index']);
Route::get('/trangchu', [ClientControllers::class, 'loadtrangchu'])->name('load.trangchu');
Route::get('/yeuthich', [ClientControllers::class, 'loadyeuthich'])->name('load.yeuthich');
Route::get('/livechat', [ClientControllers::class, 'loadlivechat'])->name('load.livechat');
Route::get('/Mchart', [ClientControllers::class, 'loadMchart'])->name('load.Mchart');
Route::get('/ranksong', [ClientControllers::class, 'loadranksong'])->name('load.ranksong');
Route::get('/topic', [ClientControllers::class, 'loadtopic'])->name('load.topic');