<?php

use App\Http\Controllers\BoughtByController;
use App\Http\Controllers\CartController;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\OrderController;
use App\Models\BoughtBy;

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

// Common Resource Routes:
// index - Show all listings
// show - Show single listing
// create - Show form to create new listing
// store - Store new listing
// edit - Show form to edit listing
// update - Update listing
// destroy - Delete listing  


// All listings 
Route::get('/', [ListingController::class, 'index']);

// Show Create Form
Route::get('/listings/create', [ListingController::class, 'create'])->middleware('auth');

// Store new listing
Route::post('/listings', [ListingController::class, 'store'])->middleware('auth');

// Edit listing
Route::get('listings/{listing}/edit', [ListingController::class, 'edit'])->middleware('auth');

// Update Listing
Route::put('/listings/{listing}', [ListingController::class, 'update'])->middleware('auth');

// Delete Listing
Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])->middleware('auth');

// Manage Listings 
Route::get('listings/manage', [ListingController::class, 'manage'])->middleware('auth');

// Single listing 
Route::get('/listings/{listing}', [ListingController::class, 'show']);

// Display order
Route::get('/orders', [OrderController::class, 'index'])->middleware('auth');

// Show Register/Create Form   
Route::get('/register', [UserController::class, 'create'])->middleware('guest');

// Create New User
Route::post('/users', [UserController::class, 'store'])->middleware('guest');

// Logout User 
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

// Show Login Form  
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

// Login User   
Route::post('/users/authenticate', [UserController::class, 'authenticate'])->middleware('guest');

// Adding product to cart
Route::get('/listings/addToCart/{listing}', [CartController::class, 'addToCart'])->middleware('auth');

// Removing product to cart
Route::get('/listings/removeFromCart/{listing}', [CartController::class, 'removeFromCart'])->middleware('auth');

// Show Cart
Route::get('/cart', [CartController::class, 'show'])->middleware('auth');

// Place An Order
Route::post('/order', [BoughtByController::class, 'order'])->middleware('auth');

// Show Users 
Route::get('/users/menu', [UserController::class, 'index'])->middleware('auth');

// Save Users Permissions
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->middleware('auth');

Route::put('/users/{user}', [UserController::class, 'update'])->middleware('auth');
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


// Show Reset Form
Route::get('/reset-password', [PasswordController::class, 'resetPassword'])->middleware('guest');

// Mail Link For Password Reset
Route::put('/reset-password', [PasswordController::class, 'mailForm'])->middleware('guest');

// Password Change Form 
Route::get('/password-change/{token}', [PasswordController::class, 'passwordChange'])->name('password.change');

// Create New Password
Route::put('/password-change', [PasswordController::class, 'passwordChangePost']);