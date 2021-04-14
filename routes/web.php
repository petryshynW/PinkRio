<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ArticlesController;
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
/*
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
*/
Route::resource('/',IndexController::class)->only('index')->names(['index'=>'home']);
Route::resource('articles',ArticlesController::class)->parameters(['articles'=>'alias']);
Route::resource('portfolios',PortfolioController::class)->parameters(['portfolios'=>'alias']);
Route::get('articles/cat/{cat_alias?}',[ArticlesController::class,'index'])->name('articlesCat');
require __DIR__.'/auth.php';
