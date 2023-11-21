<?php

use App\Http\Controllers\AnggaranController;
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
    }
);
