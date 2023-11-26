<?php

use App\Http\Controllers\AnggaranController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PemasukanController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\TabunganController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware('auth')->group(
    function(){
        Route::get('/',function(){
            return view('layouts.home');
        });
        //route anggaran
        Route::get('anggaran-index', [AnggaranController::class,'index'])->name('anggaran.index');
        Route::get('anggaran-create',[AnggaranController::class, 'create'])->name('anggaran.create');
        Route::get('anggaran-{id}-show',[AnggaranController::class,'show'])->name('anggaran.show');
        Route::get('anggaran-{id}-edit',[AnggaranController::class, 'edit'])->name('anggaran.edit');
        Route::patch('anggaran-{id}-update',[AnggaranController::class,'update'])->name('anggaran.update');
        Route::post('anggaran-store',[AnggaranController::class,'store'])->name('anggaran.store');
        Route::delete('anggaran-destroy-{id}',[AnggaranController::class,'destroy'])->name('anggaran.destroy');

        //route kategori
        Route::get('kategori-index', [KategoriController::class,'index'])->name('kategori.index');
        Route::get('kategori-create',[KategoriController::class, 'create'])->name('kategori.create');
        Route::get('kategori-{id}-show',[KategoriController::class,'show'])->name('kategori.show');
        Route::get('kategori-{id}-edit',[KategoriController::class, 'edit'])->name('kategori.edit');
        Route::patch('kategori-{id}-update',[KategoriController::class,'update'])->name('kategori.update');
        Route::post('kategori-store',[KategoriController::class,'store'])->name('kategori.store');
        Route::delete('kategori-destroy-{id}',[KategoriController::class,'destroy'])->name('kategori.destroy');

        //route pemasukan
        Route::get('pemasukan-index', [PemasukanController::class,'index'])->name('pemasukan.index');
        Route::get('pemasukan-create',[PemasukanController::class, 'create'])->name('pemasukan.create')->middleware('auth');
        Route::get('pemasukan-{id}-show',[PemasukanController::class,'show'])->name('pemasukan.show');
        Route::get('pemasukan-{id}-edit',[PemasukanController::class, 'edit'])->name('pemasukan.edit');
        Route::patch('pemasukan-{id}-update',[PemasukanController::class,'update'])->name('pemasukan.update');
        Route::post('pemasukan-store',[PemasukanController::class,'store'])->name('pemasukan.store');
        Route::delete('pemasukan-destroy-{id}',[PemasukanController::class,'destroy'])->name('pemasukan.destroy');

        //route pengeluaran
        Route::get('pengeluaran-index', [PengeluaranController::class,'index'])->name('pengeluaran.index');
        Route::get('pengeluaran-create',[PengeluaranController::class, 'create'])->name('pengeluaran.create');
        Route::get('pengeluaran-{id}-show',[PengeluaranController::class,'show'])->name('pengeluaran.show');
        Route::get('pengeluaran-{id}-edit',[PengeluaranController::class, 'edit'])->name('pengeluaran.edit');
        Route::patch('pengeluaran-{id}-update',[PengeluaranController::class,'update'])->name('pengeluaran.update');
        Route::post('pengeluaran-store',[PengeluaranController::class,'store'])->name('pengeluaran.store');
        Route::delete('pengeluaran-destroy-{id}',[PengeluaranController::class,'destroy'])->name('pengeluaran.destroy');

        //route tabungan
        Route::get('tabungan-index', [TabunganController::class,'index'])->name('tabungan.index');
        Route::get('tabungan-create',[TabunganController::class, 'create'])->name('tabungan.create');
        Route::get('tabungan-{id}-show',[TabunganController::class,'show'])->name('tabungan.show');
        Route::get('tabungan-{id}-edit',[TabunganController::class, 'edit'])->name('tabungan.edit');
        Route::patch('tabungan-{id}-update',[TabunganController::class,'update'])->name('tabungan.update');
        Route::post('tabungan-store',[TabunganController::class,'store'])->name('tabungan.store');
        Route::delete('tabungan-destroy-{id}',[TabunganController::class,'destroy'])->name('tabungan.destroy');
    }
);
