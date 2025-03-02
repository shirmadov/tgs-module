<?php

use Illuminate\Support\Facades\Route;
use Modules\Tgs\Http\Controllers\TgsController;
use Modules\Tgs\Http\Controllers\ArticleController;

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

Route::prefix('tgs')->group(function () {
    Route::get('/', [ArticleController::class, 'index'])->name("tgs.article.index");
    Route::post('/{id}/edit', [ArticleController::class, 'update'])->name("tgs.article.update");
    Route::get('/{article}/remove/', [ArticleController::class, 'destroy'])->name("tgs.article.remove");
    Route::get('/{article}/edit/', [ArticleController::class, 'edit'])->name("tgs.article.edit");
    Route::get('/{article}/show/', [ArticleController::class, 'show'])->name("tgs.article.show");
    Route::post('/{article}/accept/', [ArticleController::class, 'accept'])->name("tgs.article.accept");
    Route::post('/delete/articles', [ArticleController::class, 'deleteArticles'])->name("tgs.article.delete");
});

