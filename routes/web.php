<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\StatesController;
use App\Http\Controllers\admin\CountiesController;
use App\Http\Controllers\admin\DistrictsController;
use App\Http\Controllers\admin\SchoolsDataController;
use App\Http\Controllers\admin\SchoolsController;
use App\Http\Controllers\admin\VideosController;
use App\Http\Controllers\admin\UsersController;
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
// Route::group(['middleware' => ['role:super_admin']], function () {
//     Route::resource('states', StatesController::class);
// });


Route::prefix('admin')->middleware(['auth','role:super_admin'])->group(function () {
    Route::resource('states', StatesController::class);
    Route::resource('counties', CountiesController::class);
    Route::resource('districts', DistrictsController::class);
    Route::resource('schools', SchoolsController::class);
    Route::resource('videos', VideosController::class);
    Route::get('/users', [App\Http\Controllers\admin\UsersController::class, 'index'])->name('users');
    Route::post('/users/block', [App\Http\Controllers\admin\UsersController::class, 'block'])->name('block');
    Route::delete('/users/destroy', [App\Http\Controllers\admin\UsersController::class, 'destroy'])->name('destroy');
    Route::get('/import', [App\Http\Controllers\SchoolsDataController::class, 'index'])->name('import');
    Route::post('/import', [App\Http\Controllers\SchoolsDataController::class, 'store']);
});


Route::prefix('fm')->middleware(['auth','role:fm'])->group(function () {
    Route::get('/videos', [App\Http\Controllers\fm\VideosController::class, 'index'])->name('videos');
    Route::get('/getCounty', [App\Http\Controllers\fm\FetchData::class, 'getCounty'])->name('getCounty');
    Route::get('/getDistricts', [App\Http\Controllers\fm\FetchData::class, 'getDistricts'])->name('getDistricts');
    Route::get('/getSchools', [App\Http\Controllers\fm\FetchData::class, 'getSchools'])->name('getSchools');
    Route::resource('fund_raisers', FundraisersController::class);
});


Auth::routes();

Route::get('/sign-up', function(){
    return view('register');
})->name('sign-up');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/register-fund-manager', [App\Http\Controllers\SiteController::class, 'store_fm']);