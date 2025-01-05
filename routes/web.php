<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\ConcertController;
use App\Http\Controllers\SeatController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('home');
});

// Home route
Route::get('/home', [UserController::class, 'showHome'])->name('home');

// Login routes
Route::get('/login', [UserController::class, 'showLogin'])->name('login');
Route::post('/login', [UserController::class, 'login']);

// Register routes
Route::get('/register', [UserController::class, 'showRegister'])->name('register');
Route::post('/register', [UserController::class, 'register']);

// Logout route
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/about', function () {
    return view('about');
});

Route::get('/search', [ArtistController::class, 'search'])->name('artist.search');
Route::get('/artist/{id}', [ArtistController::class, 'show'])->name('artist.show');
Route::get('/artist/{id}/concerts', [ConcertController::class, 'byArtist']);
Route::middleware('auth')->group(function () {
    Route::get('/payment/{concertId}', [SeatController::class, 'showSeats'])->where('concertId', '[0-9]+')->name('payment.showSeats');
    Route::post('/payment/confirm', [PaymentController::class, 'store'])->name('payment.confirm');
    Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');
    Route::get('/account', [UserController::class, 'showAccount'])->name('account');
    Route::post('/account/refund', [PaymentController::class, 'processRefund'])->name('refund.process');
});

Route::get('/admin/dashboard', function (Request $request) {
    if (Auth::check() && Auth::user()->is_admin) {
        return app(AdminController::class)->dashboard($request);
    }
    return redirect('/home')->with('error', 'Unauthorized access.');
})->name('admin.dashboard');


Route::post('/admin/cancel/{id}/accept', function ($id) {
    if (Auth::check() && Auth::user()->is_admin) {
        return app(AdminController::class)->acceptCancellation($id);
    }

    return redirect('/home')->with('error', 'Unauthorized access.');
})->name('admin.accept');

Route::post('/admin/cancel/{id}/reject', function ($id) {
    if (Auth::check() && Auth::user()->is_admin) {
        return app(AdminController::class)->rejectCancellation($id);
    }

    return redirect('/home')->with('error', 'Unauthorized access.');
})->name('admin.reject');

Route::get('/register', function () {
    return view('register');
});

Route::get('/check-artist/{id}', [ArtistController::class, 'checkArtist']);

Route::get('/edit-profile', function () {
    return view('edit-profile');
})->middleware('auth');

Route::post('/update-profile', [UserController::class, 'update'])->middleware('auth');
Route::delete('/delete-account', [UserController::class, 'destroy'])->middleware('auth');
Route::get('/search/all-artists', [ArtistController::class, 'allArtists'])->name('artist.all');
