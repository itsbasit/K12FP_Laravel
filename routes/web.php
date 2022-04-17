<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\StatesController;
use App\Http\Controllers\admin\CountiesController;
use App\Http\Controllers\admin\DistrictsController;
use App\Http\Controllers\admin\SchoolsDataController;
use App\Http\Controllers\admin\SchoolsController;
use App\Http\Controllers\admin\VideosController;
// Fm Controllers 
use App\Http\Controllers\fm\FundraisersController;


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



Route::get('/dashboard', [App\Http\Controllers\admin\HomeController::class, 'index']);
Route::get('/', [App\Http\Controllers\SiteController::class, 'index'])->name('home');


// Super Admin Routes

// Admin Routes
Route::prefix('admin')->middleware(['auth','roleChecker'])->group(function () {
    Route::resource('states', StatesController::class);
    Route::resource('counties', CountiesController::class);
    Route::resource('districts', DistrictsController::class);
    Route::resource('schools', SchoolsController::class);
    Route::resource('videos', VideosController::class);
    Route::get('/import', [App\Http\Controllers\SchoolsDataController::class, 'index'])->name('import');
    Route::post('/import', [App\Http\Controllers\SchoolsDataController::class, 'store'])->name('import');
});

Route::prefix('fm')->middleware(['auth','roleChecker'])->group(function () {
    Route::get('/videos', [App\Http\Controllers\fm\VideosController::class, 'index'])->name('videos');
    Route::post('/getCounty', [App\Http\Controllers\fm\FetchData::class, 'getCounty'])->name('getCounty');
    Route::resource('fund-raisers', FundraisersController::class);
});


Auth::routes();

Route::get('/sign-up', function(){
    return view('register');
})->name('sign-up');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/register-fund-manager', [App\Http\Controllers\SiteController::class, 'store_fm']);
