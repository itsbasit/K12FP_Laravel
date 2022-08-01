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

// Route::get('/', [App\Http\Controllers\SiteController::class, 'index'])->name('home');
Route::get('/', function(){
    return view('auth.login');
});

Route::get('/home', function(){
    return view('home');
});
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


Route::prefix('fm')->middleware(['auth','role:fm','user.profile','verified'])->group(function () {
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
    
    // Invites Routes
    Route::get("/invites", [App\Http\Controllers\fm\InvitesController::class, 'index']);
    Route::get("/invites_list", [App\Http\Controllers\fm\InvitesController::class, 'invitedStudents']);
    Route::post("/submitQueue", [App\Http\Controllers\fm\InvitesController::class, 'submitQueue']);
    Route::get("/send_invite", [App\Http\Controllers\fm\InvitesController::class, 'sendInvite']);
    

    // Route::resource('fundraisers_pages', FundraiserPagesController::class);
});

Auth::routes();
Auth::routes(['verify' => true]);

Route::get("/profile", [App\Http\Controllers\ProfileController::class, 'index']);
Route::get('/fund/{slug}', [App\Http\Controllers\SiteController::class, 'fundraiserPage'])->name('fund');
Route::get('/checkout', [App\Http\Controllers\SiteController::class, 'checkout'])->name('checkout');
Route::post('/payment/add-funds/paypal', [App\Http\Controllers\PaymentController::class, 'payWithpaypal']);
Route::get('/donation/status', [App\Http\Controllers\PaymentController::class, 'getPaymentStatus']);

Route::post('complete_profile', [App\Http\Controllers\ProfileController::class, 'complete_profile']);
Route::put('update_profile', [App\Http\Controllers\ProfileController::class, 'update_profile']);
Route::post('update_dp', [App\Http\Controllers\ProfileController::class, 'updateDp']);
Route::post('change_password', [App\Http\Controllers\ProfileController::class, 'changePassword']);

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');