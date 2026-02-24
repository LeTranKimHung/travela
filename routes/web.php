<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\clients\HomeController;
use App\Http\Controllers\clients\AboutController;
use App\Http\Controllers\clients\ServiceController;
use App\Http\Controllers\clients\PackageController;
use App\Http\Controllers\clients\TourDetailController;
use App\Http\Controllers\clients\BlogController;
use App\Http\Controllers\clients\DestinationController;
use App\Http\Controllers\clients\TourController;
use App\Http\Controllers\clients\BookingController;
use App\Http\Controllers\clients\ContactController;
use App\Http\Controllers\clients\LoginController;
use App\Http\Controllers\clients\UserController;
use App\Http\Controllers\clients\PaymentController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\TourAdminController;
use App\Http\Controllers\Admin\BookingAdminController;
use App\Http\Controllers\Admin\PostAdminController;
use App\Http\Controllers\Admin\GalleryAdminController;
use App\Http\Controllers\Admin\ReviewAdminController;
use App\Http\Controllers\Admin\UserAdminController;



//Handle Login
Route::get('/login', [LoginController::class, 'index'])->name('login');

// [FIX] Thêm dòng này để cho phép truy cập trang đăng ký bằng đường dẫn
Route::get('/register', [LoginController::class, 'showRegisterForm'])->name('register.form');

Route::post('/register', [LoginController::class, 'register'])->name('register');
Route::post('/login', [LoginController::class, 'login'])->name('user-login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('activate-account/{token}', [LoginController::class, 'activateAccount'])->name('activate.account');
// ===== PUBLIC ROUTES =====

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/services', [ServiceController::class, 'index'])->name('services');
Route::get('/packages', [PackageController::class, 'index'])->name('packages');
Route::get('/tour-detail/{id}', [TourDetailController::class, 'index'])->name('tour-detail');
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/blog-detail/{id}', [BlogController::class, 'show'])->name('blog-detail');
Route::get('/destination', [DestinationController::class, 'index'])->name('destination');
Route::get('/tours', [TourController::class, 'index'])->name('tours');
Route::get('/filter-tours', [TourController::class, 'filterTours'])->name('filter.tours');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact/submit', [ContactController::class, 'submit'])->name('contact.submit');

// ===== PROTECTED ROUTES (Require Login) =====

Route::middleware(['checkLoginClient'])->group(function () {
    // User Profile
    Route::get('/profile', [UserController::class, 'index'])->name('profile');
    Route::post('/profile/update', [UserController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/change-password', [UserController::class, 'changePassword'])->name('profile.change-password');
    Route::post('/profile/upload-avatar', [UserController::class, 'uploadAvatar'])->name('profile.upload-avatar');
    Route::get('/profile/cancel-tour/{bookingId}', [UserController::class, 'cancelTour'])->name('profile.cancel-tour');
    
    // Booking
    Route::get('/booking/{tourId}', [BookingController::class, 'index'])->name('booking');
    Route::post('/booking/submit', [BookingController::class, 'submit'])->name('booking.submit');
    
    // Reviews
    Route::post('/reviews/check-booking', [TourDetailController::class, 'checkBooking'])->name('reviews.check-booking');
    Route::post('/reviews/submit', [TourDetailController::class, 'submitReview'])->name('reviews.submit');
});

// ===== PAYMENT ROUTES =====

Route::prefix('payment')->group(function () {
    Route::get('/', [PaymentController::class, 'index'])->name('payment.index');
    Route::post('/process', [PaymentController::class, 'process'])->name('payment.process');
    Route::post('/momo', [PaymentController::class, 'momoPayment'])->name('payment.momo');
    Route::get('/momo/callback', [PaymentController::class, 'momoCallback'])->name('payment.momo.callback');
    Route::post('/paypal', [PaymentController::class, 'paypalPayment'])->name('payment.paypal');
    Route::get('/paypal/success', [PaymentController::class, 'paypalSuccess'])->name('payment.paypal.success');
    Route::get('/paypal/cancel', [PaymentController::class, 'paypalCancel'])->name('payment.paypal.cancel');
    Route::get('/zalopay', [PaymentController::class, 'zalopayView'])->name('payment.zalopay.view');
    Route::post('/zalopay/submit', [PaymentController::class, 'zalopaySubmit'])->name('payment.zalopay.submit');
});

// ===== ADMIN ROUTES =====
Route::middleware(['admin'])->prefix('admin')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    
    // Quản lý Tours
    Route::get('/tours', [TourAdminController::class, 'index'])->name('admin.tours.index');
    Route::get('/tours/create', [TourAdminController::class, 'create'])->name('admin.tours.create');
    Route::post('/tours/store', [TourAdminController::class, 'store'])->name('admin.tours.store');
    Route::get('/tours/edit/{id}', [TourAdminController::class, 'edit'])->name('admin.tours.edit');
    Route::post('/tours/update/{id}', [TourAdminController::class, 'update'])->name('admin.tours.update');
    Route::post('/tours/destroy/{id}', [TourAdminController::class, 'destroy'])->name('admin.tours.destroy');
    
    // Quản lý Booking
    Route::get('/bookings', [BookingAdminController::class, 'index'])->name('admin.bookings.index');
    Route::post('/bookings/update-status/{id}/{status}', [BookingAdminController::class, 'updateStatus'])->name('admin.bookings.update-status');

    // Quản lý Bài viết (Blog)
    Route::get('/posts', [PostAdminController::class, 'index'])->name('admin.posts.index');
    Route::get('/posts/create', [PostAdminController::class, 'create'])->name('admin.posts.create');
    Route::post('/posts/store', [PostAdminController::class, 'store'])->name('admin.posts.store');
    Route::get('/posts/edit/{id}', [PostAdminController::class, 'edit'])->name('admin.posts.edit');
    Route::post('/posts/update/{id}', [PostAdminController::class, 'update'])->name('admin.posts.update');
    Route::post('/posts/destroy/{id}', [PostAdminController::class, 'destroy'])->name('admin.posts.destroy');

    // Quản lý Gallery
    Route::get('/galleries', [GalleryAdminController::class, 'index'])->name('admin.galleries.index');
    Route::get('/galleries/create', [GalleryAdminController::class, 'create'])->name('admin.galleries.create');
    Route::post('/galleries/store', [GalleryAdminController::class, 'store'])->name('admin.galleries.store');
    Route::get('/galleries/edit/{id}', [GalleryAdminController::class, 'edit'])->name('admin.galleries.edit');
    Route::post('/galleries/update/{id}', [GalleryAdminController::class, 'update'])->name('admin.galleries.update');
    Route::post('/galleries/destroy/{id}', [GalleryAdminController::class, 'destroy'])->name('admin.galleries.destroy');

    // Quản lý Review (Testimonial)
    Route::get('/reviews', [ReviewAdminController::class, 'index'])->name('admin.reviews.index');
    Route::get('/reviews/create', [ReviewAdminController::class, 'create'])->name('admin.reviews.create');
    Route::post('/reviews/store', [ReviewAdminController::class, 'store'])->name('admin.reviews.store');
    Route::get('/reviews/edit/{id}', [ReviewAdminController::class, 'edit'])->name('admin.reviews.edit');
    Route::post('/reviews/update/{id}', [ReviewAdminController::class, 'update'])->name('admin.reviews.update');
    Route::post('/reviews/destroy/{id}', [ReviewAdminController::class, 'destroy'])->name('admin.reviews.destroy');

    // Quản lý Tài khoản
    Route::get('/users', [UserAdminController::class, 'index'])->name('admin.users.index');
    Route::get('/users/create', [UserAdminController::class, 'create'])->name('admin.users.create');
    Route::post('/users/store', [UserAdminController::class, 'store'])->name('admin.users.store');
    Route::get('/users/edit/{id}', [UserAdminController::class, 'edit'])->name('admin.users.edit');
    Route::post('/users/update/{id}', [UserAdminController::class, 'update'])->name('admin.users.update');
    Route::post('/users/destroy/{id}', [UserAdminController::class, 'destroy'])->name('admin.users.destroy');
});