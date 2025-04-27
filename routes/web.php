<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OfferRequestController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', [PagesController::class, 'home'])->name('home');
Route::get('offers/{id}/show_details', [PagesController::class, 'showDetails'])->name('offers.show_details');
Route::get('offers/offers_list', [PagesController::class, 'offersList'])->name('offers.offers_list');

Route::get('/test', function () {
    return view('test');
});
Route::get('/test2', function () {
    return view('test2');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// authentication routes:


Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');

Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');








Route::middleware(['auth'])->group(function () {

// Route::get('/dash',function(){return view('dashboard');})->name('dashboard');
Route::get("/dashboard",[DashboardController::class,"index"])->name("dashboard");
Route::resource('users', UserController::class);
Route::resource('categories', CategoryController::class);
Route::resource('/offers',OfferController::class);
// Route::post('users', [UserController::class,"store"])->name('users.store');

// Route::get('/users/create',function(){return view('users.create');})->name('users.create');

Route::get('/profile',function(){return view('users.profile');})->name('users.profile');

Route::get('/tags/index',function(){return view('tags.index');})->name('tags.index');

Route::get('/tags/create',function(){return view('tags.create');})->name('tags.create');

//The offers related endpoints

Route::get("/create_offer",[offerController::class,"createUserOffer"])->name("createOffer");
Route::patch("/offers/{id}/suspend", [OfferController::class,"suspend"])->name('offers.suspend');
Route::patch("/offers/{id}/reactivate", [OfferController::class,"reactivate"])->name('offers.reactivate');
Route::get("/offers/{offerId}/ask_to_join",[OfferRequestController::class,"askToJoin"]);
Route::get("/offers/{offerId}/cancel_demande",[OfferRequestController::class,"cancelDemande"]);

// Route::get('/offers/index',function(){return view('offers.index');})->name('offers.index');

// Route::get('/offers/create',function(){return view('offers.create');})->name('offers.create');
});

//this is just for the test
Route::get("/hello",function(){return "heelo";})->middleware(["auth"]);





