<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\clients\AboutController;
use App\Http\Controllers\clients\ServiceController;
use App\Http\Controllers\clients\PackageController;
use App\Http\Controllers\clients\BlogController;
use App\Http\Controllers\clients\DestinationController;
use App\Http\Controllers\clients\TourController;
use App\Http\Controllers\clients\BookingController;
use App\Http\Controllers\clients\GalleryController;
use App\Http\Controllers\clients\GuidesController;
use App\Http\Controllers\clients\TestimonialController;
use App\Http\Controllers\clients\NotFoundController;
use App\Http\Controllers\clients\ContactController;
use App\Http\Controllers\clients\TourDetailController;
use App\Http\Controllers\clients\PaymentController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\clients\UserController;

//admin
use App\Http\Controllers\Admin\{AdminDashboardController, TourAdminController, BookingAdminController};


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/services', [ServiceController::class, 'index'])->name('services');
Route::get('/packages', [PackageController::class, 'index'])->name('packages');
Route::get('/tour-detail/{id}', [TourDetailController::class, 'index'])->name('tour-detail');
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/destination', [DestinationController::class, 'index'])->name('destination');
Route::get('/tours', [TourController::class, 'index'])->name('tours');
Route::get('/booking', [BookingController::class, 'index'])->name('booking');
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');
Route::get('/guides', [GuidesController::class, 'index'])->name('guides');
Route::get('/testimonial', [TestimonialController::class, 'index'])->name('testimonial');
Route::get('/404', [NotFoundController::class, 'index'])->name('404');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Payment Routes (with auth middleware)
Route::middleware(['auth'])->group(function () {
    Route::post('/payment', [PaymentController::class, 'index'])->name('payment');
    Route::post('/payment/process', [PaymentController::class, 'process'])->name('payment.process');
    Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');
    Route::get('/payment/cancel', [PaymentController::class, 'cancel'])->name('payment.cancel');
});

// Payment routes
Route::prefix('payment')->group(function () {
    Route::get('/', [PaymentController::class, 'index'])->name('payment');
    Route::post('/process', [PaymentController::class, 'process'])->name('payment.process');
    Route::get('/success', [PaymentController::class, 'success'])->name('payment.success');
    Route::get('/cancel', [PaymentController::class, 'cancel'])->name('payment.cancel');
});
// Registration Routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Đăng nhập
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
// User Profile Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::post('/profile/update', [UserController::class, 'updateProfile'])->name('profile.update');
});

// // Guest Routes
// Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
// Route::post('/login', [LoginController::class, 'login']);
// Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Admin Routes (Protected by Auth and Admin Middleware)
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    
    // Tours
    Route::get('/tours', [TourAdminController::class, 'index'])->name('admin.tours.index');
    Route::get('/tours/create', [TourAdminController::class, 'create'])->name('admin.tours.create');
    Route::post('/tours', [TourAdminController::class, 'store'])->name('admin.tours.store');

    // Bookings
    Route::get('/bookings', [BookingAdminController::class, 'index'])->name('admin.bookings.index');
    Route::post('/bookings/{id}/{status}', [BookingAdminController::class, 'updateStatus'])->name('admin.bookings.update');
});