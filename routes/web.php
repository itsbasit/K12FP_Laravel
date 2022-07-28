<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\StatesController;
use App\Http\Controllers\admin\CountiesController;
use App\Http\Controllers\admin\DistrictsController;
use App\Http\Controllers\admin\SchoolsController;
use App\Http\Controllers\admin\VideosController;
// Fm Controllers 
use App\Http\Controllers\fm\FundraisersController;
use App\Http\Controllers\fm\StudentsController;
use App\Http\Controllers\fm\ElementaryStudentsController;
// use App\Http\Controllers\fm\FundraiserPagesController;
use Illuminate\Support\Facades\Auth;



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


Route::get('/dashboard', [App\Http\Controllers\admin\HomeController::class, 'index'])->middleware(['auth']);;

Route::get('/', [App\Http\Controllers\SiteController::class, 'index'])->name('home');

// Super Admin Routes
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

    Route::get("/fundraisers", [App\Http\Controllers\admin\Fundraisers::class, 'index'])->name("fundraisers");
    Route::put("/fundraisers/block/{id}", [App\Http\Controllers\admin\Fundraisers::class, 'block']);
    Route::put("/fundraisers/unblock/{id}", [App\Http\Controllers\admin\Fundraisers::class, 'unblock']);
    Route::post("/fundraisers/delete/{id}", [App\Http\Controllers\admin\Fundraisers::class, 'delete']);
    Route::get("/fundraisers/{id}/view", [App\Http\Controllers\admin\Fundraisers::class, 'view_fundraiser']);
    Route::get("/profile", [App\Http\Controllers\ProfileController::class, 'index']);

});


Route::prefix('fm')->middleware(['auth','role:fm'])->group(function () {
    Route::get('/videos', [App\Http\Controllers\fm\VideosController::class, 'index'])->name('videos');
    Route::get('/getCounty', [App\Http\Controllers\fm\FetchData::class, 'getCounty'])->name('getCounty');
    Route::get('/getDistricts', [App\Http\Controllers\fm\FetchData::class, 'getDistricts'])->name('getDistricts');
    Route::get('/getSchools', [App\Http\Controllers\fm\FetchData::class, 'getSchools'])->name('getSchools');
    Route::get('/getSchoolByName', [App\Http\Controllers\fm\FetchData::class, 'getSchoolByName'])->name('getSchoolByName');
    Route::get('/checkSlug', [App\Http\Controllers\fm\FetchData::class, 'checkSlug'])->name('checkSlug');
    Route::get('/checkStudentGoal', [App\Http\Controllers\fm\FetchData::class, 'checkFundraiserStudentGoal'])->name('checkStudentGoal');
    Route::resource('fund_raisers', FundraisersController::class);
    Route::resource('students', StudentsController::class);
    Route::resource('elementary_students', ElementaryStudentsController::class);

    // Fundraiser Pages Routes
    Route::get("/pages", [App\Http\Controllers\fm\Pages\FundraiserPagesController::class, 'index']);
    Route::get("/main/create", [App\Http\Controllers\fm\Pages\FundraiserPagesController::class, 'createMainPage']);
    Route::post("/main/store", [App\Http\Controllers\fm\Pages\FundraiserPagesController::class, 'StoreMainPage']);
    Route::get("/main/{id}/edit", [App\Http\Controllers\fm\Pages\FundraiserPagesController::class, 'editMainPage']);
    Route::put("/main/{id}/update", [App\Http\Controllers\fm\Pages\FundraiserPagesController::class, 'updateMainPage'])->name("main_update");
    
    // Student page
    Route::get("/student/create", [App\Http\Controllers\fm\Pages\FundraiserPagesController::class, 'createStudentPage']);
    Route::post("/student/store", [App\Http\Controllers\fm\Pages\FundraiserPagesController::class, 'StoreStudentPage']);
    Route::get("/student/{id}/edit", [App\Http\Controllers\fm\Pages\FundraiserPagesController::class, 'editStudentPage']);
    Route::put("/student/{id}/update", [App\Http\Controllers\fm\Pages\FundraiserPagesController::class, 'updateStudentPage'])->name("student_update");;
    Route::get("/page/destroy/{id}", [App\Http\Controllers\fm\Pages\FundraiserPagesController::class, 'destroy']);
    Route::get("/profile", [App\Http\Controllers\ProfileController::class, 'index']);
    
    // Route::resource('fundraisers_pages', FundraiserPagesController::class);
});

Auth::routes();

Route::get('/sign-up', function(){
    return view('register');
})->name('sign-up');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/register-fund-manager', [App\Http\Controllers\SiteController::class, 'store_fm']);
Route::get('/fund/{slug}', [App\Http\Controllers\SiteController::class, 'fundraiserPage'])->name('fund');
