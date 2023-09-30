<?php

use App\Http\Controllers\LocalizationController;
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

// https://nouvelle-techno.fr/articles/laravel-creer-un-site-multilingue
// Route qui permet de connaître la langue active
Route::get('locale', [LocalizationController::class, 'getLang'])->name('get-lang');

// Route qui permet de modifier la langue
Route::get('locale/{lang}', [LocalizationController::class, 'setLang'])->name('set-lang');

Route::get('/', function () {
    return view('welcome');
});

// Customer web routes
require __DIR__ . '/web/customer.php';

// Administrator web routes
require __DIR__ . '/web/administrator.php';
