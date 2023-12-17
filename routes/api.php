<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MobileController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('/mobile/login',[MobileController::class,'login']);
Route::get('/mobile/ceklogin',[MobileController::class,'ceklogin']);
Route::post('/mobile/register',[MobileController::class,'register']);
Route::post('/mobile/logout',[MobileController::class,'logout']);
Route::get('/mobile/kategori',[MobileController::class,'indexKategori']);
Route::get('/mobile/anggaran/index',[MobileController::class,'indexAnggaran']);
Route::post('/mobile/anggaran/create',[MobileController::class,'createAnggaran']);
Route::post('/mobile/anggaran/update/{id}',[MobileController::class,'editAnggaran']);
Route::post('/mobile/anggaran/delete/{id}',[MobileController::class,'deleteAnggaran']);
Route::get('/mobile/pemasukan/index',[MobileController::class,'indexPemasukan']);
Route::post('/mobile/pemasukan/create',[MobileController::class,'createPemasukan']);
Route::post('/mobile/pemasukan/update/{id}',[MobileController::class,'editPemasukan']);
Route::post('/mobile/pemasukan/delete/{id}',[MobileController::class,'deletePemasukan']);
Route::get('/mobile/userAktif',[MobileController::class,'userAktif']);
Route::get('/mobile/pengeluaran/index',[MobileController::class,'indexPengeluaran']);
Route::post('/mobile/pengeluaran/create',[MobileController::class,'createPengeluaran']);
Route::post('/mobile/pengeluaran/update/{id}',[MobileController::class,'editPengeluaran']);
Route::post('/mobile/pengeluaran/delete/{id}',[MobileController::class,'deletePengeluaran']);
Route::get('/mobile/tabungan/index',[MobileController::class,'indexTabungan']);
Route::post('/mobile/tabungan/create',[MobileController::class,'createTabungan']);