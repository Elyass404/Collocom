<?php

use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SituationsController;
use App\Http\Controllers\OfferRequestController;
use App\Http\Controllers\SupportMessageController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', [PagesController::class, 'home'])->name('home');
Route::get('offers/{id}/show_details', [PagesController::class, 'showDetails'])->name('offers.show_details');
Route::get('offers/offers_list', [PagesController::class, 'offersList'])->name('offers.offers_list');
Route::get('contact_us', [PagesController::class, 'contact'])->name('contact_us');
Route::get('about_us', [PagesController::class, 'aboutUs'])->name('about_us');
Route::post('contact_us/send_message', [SupportMessageController::class, 'sendMessage'])->name('support.sendMessage');

Route::get('/test', function () {
    return view('test');
});

// Route::get('/test2', function () { return view('test2'); })->middleware('role:admin');

Route::middleware(['auth','role:admin'])->group(function () {
    Route::get('/test2', function () { return view('test2'); });
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
Route::resource('situations', SituationsController::class);
Route::resource('offers',OfferController::class);

//Support Messages 
Route::get("/support/index",[SupportMessageController::class,"index"])->name("support.index");
Route::get("/support/{id}/show_message",[SupportMessageController::class,"show"])->name("support.show");
Route::patch("/support/{id}/mark_read",[SupportMessageController::class,"markRead"])->name("support.mark_read");
Route::patch("/support/{id}/mark_unread",[SupportMessageController::class,"markUnread"])->name("support.mark_unread");
Route::delete("/support/{id}/destroy",[SupportMessageController::class,"destroy"])->name("support.destroy");
Route::post("/support/{id}/reply",[SupportMessageController::class,"reply"])->name("support.reply");

// Route::put("/offers/{offerId}",[OfferController::class,"update"])->name("offers.update");
// Route::get("/offers/{offerId}/edit",[OfferController::class,"edit"])->name("offers.edit");
// Route::get("/offers/create",[OfferController::class,"create"])->name("offers.create");
// Route::get("/offers/{offerId}",[OfferController::class,"show"])->name("offers.show");
// Route::get("/offers",[OfferController::class,"index"])->name("offers.index");
// Route::delete("/offers/{offerId}", [OfferController::class, "destroy"])->name("offers.destroy");
// Route::post('users', [UserController::class,"store"])->name('users.store');

// Route::get('/users/create',function(){return view('users.create');})->name('users.create');

Route::get('/profile/{id}',[UserController::class,"profile"])->name('users.profile');
Route::get('/profile/{id}/edit_profile',[UserController::class,"editProfile"])->name('users.edit_profile');

Route::get('/tags/index',function(){return view('tags.index');})->name('tags.index');

Route::get('/tags/create',function(){return view('tags.create');})->name('tags.create');

//The offers related endpoints

Route::get("/create_offer",[offerController::class,"createUserOffer"])->name("createOffer");
Route::patch("/offers/{id}/suspend", [OfferController::class,"suspend"])->name('offers.suspend');
Route::patch("/offers/{id}/reactivate", [OfferController::class,"reactivate"])->name('offers.reactivate');
Route::patch("/offers/{id}/pause", [OfferController::class,"pause"])->name('offers.pause');
Route::get("/offers/{offerId}/ask_to_join",[OfferRequestController::class,"askToJoin"]);
Route::get("/offers/{offerId}/cancel_demande",[OfferRequestController::class,"cancelDemande"]);
Route::get("/offers/{offerId}/reject_demande",[OfferRequestController::class,"rejectRequest"])->name("offers.rejectDemand");
Route::get("/offers/{offerId}/accept_demande",[OfferRequestController::class,"acceptRequest"])->name("offers.acceptDemand");
Route::get("/offers/{offerId}/pending_demande",[OfferRequestController::class,"pendingRequest"])->name("offers.pendingDemand");
Route::get("/offers/{offerId}/confirm_demande",[OfferRequestController::class,"pendingRequest"])->name("offers.confirmDemand");

Route::get('/my_offer',[OfferController::class,"myOffer"])->name('my_offer');
Route::get('/my_offer/demands',[OfferController::class,"offerDemands"])->name('my_offer.demands');
Route::get('/user/{userId}/sent_demands',[OfferRequestController::class,"userSentDemands"])->name('sent_demands');


// Route::get('/offers/index',function(){return view('offers.index');})->name('offers.index');

// Route::get('/offers/create',function(){return view('offers.create');})->name('offers.create');
});

//this is just for the test
Route::get("/hello",function(){return "heelo";})->middleware(["auth"]);





