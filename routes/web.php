<?php

use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\CategorieController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\MarqueController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\OrderCouponController;
use App\Http\Controllers\Admin\OrderItemController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\WishlistController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\HomeController as ClientHomeController;
use App\Http\Controllers\Client\LoginController as ClientLoginController;
use App\Http\Controllers\Client\OrderController as ClientOrderController;
use App\Http\Controllers\Client\PasswordController;
use App\Http\Controllers\Client\ProductController as ClientProductController;
use App\Http\Controllers\Client\ProfileController;
use App\Http\Controllers\Client\SignUpController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [ClientHomeController::class, 'index'])->name('home');
Route::get('/about', [ClientHomeController::class, 'about'])->name('about');
Route::get('/contact', [ClientHomeController::class, 'contact'])->name('contact');
Route::get('/products', [ClientProductController::class, 'index'])->name('product.all');
Route::get('/cart', [ClientHomeController::class, 'cart'])->name('cart');
Route::get('/product/{id}', [ClientProductController::class, 'show'])->name('product.show');
Route::post('/products/{product}/reviews', [App\Http\Controllers\Client\ReviewController::class, 'store'])->name('client.reviews.store');



Route::get('/login', [ClientLoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::get('/logout', [ClientLoginController::class, 'logout'])->name('logout')->middleware('auth');
Route::post('/login', [ClientLoginController::class, 'login'])->name('dologin');

Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])
    ->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])
    ->name('password.email');
Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])
    ->name('password.reset');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])
    ->name('password.update');

Route::get('/signup', [SignUpController::class, 'showSignupForm'])->name('signup');
Route::post('/signup', [SignUpController::class, 'signup']);
Route::get('/verify-email/{token}', [SignUpController::class, 'verifyEmail'])->name('verify.email');
Route::post('/resend-verification-email', [SignUpController::class, 'resendVerificationEmail'])->name('resend.verification.email');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

Route::get('/change-password', [PasswordController::class, 'showChangePasswordForm'])->name('password.change')->middleware('auth');
Route::post('/change-password', [PasswordController::class, 'changePassword'])->name('password.update')->middleware('auth');
Route::middleware(['auth'])->group(function () {
    Route::get('/orders', [ClientOrderController::class, 'index'])->name('client.orders.index');
    Route::get('/orders/{id}', [ClientOrderController::class, 'show'])->name('client.orders.show');
    Route::get('/orders/{id}/cancel', [ClientOrderController::class, 'cancel'])->name('client.orders.cancel');
    Route::get('/orders/{id}/track', [ClientOrderController::class, 'trackOrder'])->name('client.orders.track');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/commandes',[ClientOrderController::class,'orders']);
    Route::get('/payment/options', [App\Http\Controllers\Client\PaymentController::class, 'showPaymentOptions'])->name('payment.options');
    Route::post('/payment/process', [App\Http\Controllers\Client\PaymentController::class, 'processPayment'])->name('payment.process');
    Route::get('/payment/success', [App\Http\Controllers\Client\PaymentController::class, 'success'])->name('payment.success');
    Route::get('/payment/cancel', [App\Http\Controllers\Client\PaymentController::class, 'cancel'])->name('payment.cancel');
    Route::get('/payment/mobile/confirm/{order}', [App\Http\Controllers\Client\PaymentController::class, 'mobileConfirm'])->name('payment.mobile.confirm');
    Route::get('/payment/cash/confirm/{order}', [App\Http\Controllers\Client\PaymentController::class, 'cashConfirm'])->name('payment.cash.confirm');
});
// Admin Routes
Route::get('/admin/login', [LoginController::class, 'login'])->name('admin.login');
Route::post('/admin/login', [LoginController::class, 'doLogin'])->name('admin.dologin');
Route::prefix('admin')->name('admin.')->middleware(['admin', 'role'])->group(function () {
    Route::resource('users', AdminUserController::class);
    Route::post('users/{user}/toggle-active', [AdminUserController::class, 'toggleActive'])->name('users.toggle-active');
    Route::post('users/{user}/reset-password', [AdminUserController::class, 'resetPassword'])->name('users.reset-password');
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::resource('marques', MarqueController::class);
    Route::resource('categories', CategorieController::class);
    Route::resource('products', ProductController::class);
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::resource('orders', OrderController::class)->except(['create', 'store', 'edit', 'update']);
    Route::put('orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.update-status');
    Route::put('order-items/{orderItem}', [OrderItemController::class, 'update'])->name('order-items.update');
    Route::delete('order-items/{orderItem}', [OrderItemController::class, 'destroy'])->name('order-items.destroy');
    Route::resource('payments', PaymentController::class)->except(['create', 'edit', 'update']);
    Route::put('payments/{payment}/status', [PaymentController::class, 'updateStatus'])->name('payments.update-status');
    Route::resource('reviews', ReviewController::class)->except(['create', 'store']);
    Route::resource('coupons', CouponController::class);
    Route::resource('order-coupons', OrderCouponController::class)->only(['index', 'show', 'destroy']);
    Route::resource('wishlists', WishlistController::class)->only(['index', 'show', 'destroy']);
    Route::patch('categories/{category}/activate', [CategorieController::class, 'activate'])->name('categories.activate');
});
