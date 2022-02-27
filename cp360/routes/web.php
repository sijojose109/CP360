<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;

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

// Route::get('/', function () {
//     return view('welcome');
// });
require __DIR__.'/auth.php';


Route::get('/dashboard', [FormController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::get('/form/create', [FormController::class, 'create'])->middleware(['auth'])->name('form.create');


Route::get('/', [FormController::class, 'index'])->name('form.list');

Route::post('/form/save', [FormController::class, 'store'])->middleware(['auth'])->name('form.store');

Route::post('/form/delete', [FormController::class, 'delete'])->middleware(['auth'])->name('form.delete');

Route::get('/form/{id}', [FormController::class, 'show'])->name('form.show');
