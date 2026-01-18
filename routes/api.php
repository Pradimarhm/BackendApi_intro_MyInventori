<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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

Route::middleware(['apicheck'])->group(function () {
    Route::prefix('product')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('product.index');

        Route::get('/{id}', [ProductController::class, 'edit'])->name('product.edit');
        Route::patch('/update/{id}', [ProductController::class, 'update'])->name('product.update');

        Route::post('/create', [ProductController::class, 'create'])->name('product.create');

        Route::delete('/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');
    });
});

// Route::prefix('product')->group(function () {
//     Route::get('/', [ProductController::class, 'index'])->name('product.index');

//     Route::get('/{id}', [ProductController::class, 'edit'])->name('product.edit');
//     Route::patch('/update/{id}', [ProductController::class, 'update'])->name('product.update');

//     Route::post('/create', [ProductController::class, 'create'])->name('product.create');

//     Route::delete('/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');
// });
