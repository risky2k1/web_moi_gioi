<?php


use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('layout.master');
})->name('welcome');

Route::group([
    'as'     => 'users.',
    'prefix' => 'users',
    ],function (){
    Route::get('/',[UserController::class,'index'])->name('index');
    Route::get('/{id}',[UserController::class,'show'])->name('show');
    Route::delete('/{id}',[UserController::class,'destroy'])->name('destroy');
});

Route::group([
    'as'     => 'posts.',
    'prefix' => 'posts',
],function (){
    Route::get('/',[PostController::class,'index'])->name('index');
    Route::get('/create',[PostController::class,'create'])->name('create');
    Route::post('/import-csv',[PostController::class,'importCsv'])->name('import_csv');
//    Route::get('/{id}',[UserController::class,'show'])->name('show');
//    Route::delete('/{id}',[UserController::class,'destroy'])->name('destroy');
});
