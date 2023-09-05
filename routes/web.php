<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\BranchController;
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
Route::get('/', [BusinessController::class,'index'])->name('business.index');
Route::get('/create', [BusinessController::class,'create'])->name('business.create');
Route::post('/store', [BusinessController::class,'store'])->name('business.store');

// Branch
Route::get('/branch/{id}', [BranchController::class,'index'])->name('branches.index');
