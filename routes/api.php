<?php

use Illuminate\Support\Facades\Route;
use Modules\Tgs\Http\Controllers\TgsController;
use Modules\Tgs\Http\Controllers\Api\TgsArticleController;

/*
 *--------------------------------------------------------------------------
 * API Routes
 *--------------------------------------------------------------------------
 *
 * Here is where you can register API routes for your application. These
 * routes are loaded by the RouteServiceProvider within a group which
 * is assigned the "api" middleware group. Enjoy building your API!
 *
*/

//Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
//    Route::apiResource('tgs', TgsController::class)->names('tgs');
//});

Route::post('article',[TgsArticleController::class,'store']);
