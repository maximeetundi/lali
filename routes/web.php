<?php

declare(strict_types=1);

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// Homepage uses the existing index view (now on Yummy layout)
Route::view('/', 'index')->name('home');

// Preserve legacy homepage at /legacy
Route::get('/legacy', [HomeController::class, 'index'])->name('home.legacy');
Route::get('/view/product/{product}', [HomeController::class, 'show'])->name('product.view');
Route::supportBubble();

// Yummy frontend preview route
Route::view('/yummy', 'yummy.index')->name('yummy.preview');
