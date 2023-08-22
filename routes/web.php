<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\PaymentProviderController;
use App\Http\Controllers\SochialController;
use App\Http\Controllers\TowfactoreController;
use App\Http\Controllers\WinnerController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [HomeController::class,'index'])->middleware(['auth', 'verified','tow_factor',])->name('dashboard');
Route::post('comment', [HomeController::class,'saveComment'])->name('comment.save');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


################Begin paymentGateways Routes ########################

Route::group([ 'middleware' => 'auth'], function () {
    Route::get('offers', [OfferController::class,'index'])->name('offers.all');
    Route::get('details/{offer_id}', [OfferController::class,'show'])->name('offers.show');
});

Route::get('get-checkout-id', [PaymentProviderController::class,'getCheckOutId'])->name('offers.checkout');

################End paymentGateways Routes ########################

################job && Queues ########################

Route::get('/send/email', [HomeController::class,'send_email'])->middleware(['auth', 'verified'])->name('send_email');

################End job && Queues ########################

Route::get('/view', [WinnerController::class,'index'])->middleware(['auth', 'verified'])->name('view.users');

Route::post('/save/users', [WinnerController::class,'save'])->middleware(['auth', 'verified'])->name('save.users');

Route::get('/auth/googel', [SochialController::class,'google']);
Route::get('/auth/googel/callback', [SochialController::class,'handelGoogel']);


Route::resource('verify',TowfactoreController::class);
require __DIR__.'/auth.php';
