<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactsController;
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
Route::resource('/',IndexController::class)->only('index')->names(['index'=>'home']);

Route::resource('articles',ArticlesController::class)->parameters(['articles'=>'alias']);
Route::resource('portfolios',PortfolioController::class)->parameters(['portfolios'=>'alias']);
Route::get('articles/cat/{cat_alias?}',[ArticlesController::class,'index'])->name('articlesCat');
Route::resource('comment',CommentController::class)->only('store');
Route::match(['get','post'],'/contacts',[ContactsController::class,'index'])->name('contacts');

Route::get('/login',[\App\Http\Controllers\Auth\AuthenticatedSessionController::class,'create']);
Route::post('/login',[\App\Http\Controllers\Auth\AuthenticatedSessionController::class,'store']);
Route::get('/logout',[\App\Http\Controllers\Auth\AuthenticatedSessionController::class,'destroy']);

Route::middleware(['auth'])->group(function (){
    Route::group(['prefix'=>'admin'],function ()
    {
        Route::get('/',[\App\Http\Controllers\Admin\IndexController::class,'index'])->name('admin');
        Route::group(['prefix'=>'articles'],function ()
        {
            Route::get('/',[\App\Http\Controllers\Admin\ArticlesController::class,'index']);
            Route::get('/newArticle',[\App\Http\Controllers\Admin\ArticlesController::class,'create']);
            Route::post('/add',[\App\Http\Controllers\Admin\ArticlesController::class,'store'])->name('store');
            Route::put('/update',[\App\Http\Controllers\Admin\ArticlesController::class,'update'],function (\App\Models\Article $article){
                return $article;
            })->name('update');
            Route::get('/{article:alias}/edit',[\App\Http\Controllers\Admin\ArticlesController::class,'edit'],function (\App\Models\Article $article){
                return $article;
            });

        });

    });

});

require __DIR__.'/auth.php';
