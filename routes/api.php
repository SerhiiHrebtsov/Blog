<?php

use App\Http\Controllers\Api\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'prefix'     => 'v1',
    'middleware' => 'api',
], function () {
    Route::middleware('auth')->group(function () {
        // Posts
        Route::group([
            'prefix' => 'posts',
            'as'     => 'posts.',
        ], function () {
            Route::get('/', [PostController::class, 'index'])
                ->name('index');
            Route::post('/', [PostController::class, 'store'])
                ->name('store');
            Route::patch('/{post}', [PostController::class, 'update'])
                ->name('update');
            Route::delete('/{post}', [PostController::class, 'destroy'])
                ->name('destroy');
        });
    });
});
