<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AdviceController;
use App\Http\Controllers\OrderController as UserOrderController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\FacebookController;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ProductController;

use App\Http\Controllers\ExercisesController;
use App\Http\Controllers\StripeWebhookController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\Admin\NotificationsController;
use App\Http\Controllers\NewsletterController;


// =======================
// HOME
// =======================
Route::get('/', fn () => view('welcome'))->name('home');


// =======================
// PUBLIC PAGES
// =======================
Route::get('/exercises', [ExercisesController::class, 'index'])->name('exercises.index');

Route::get('/store', [StoreController::class, 'index'])->name('store.index');

Route::get('/advice', [AdviceController::class, 'index'])->name('advice.index');
Route::post('/advice/bmi', [AdviceController::class, 'bmi'])->name('advice.bmi');

// =======================
// EMAIL->subscribe button
// =======================
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

// =======================
// DASHBOARD (auth + verified)
// =======================
Route::get('/dashboard', fn () => view('dashboard'))
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


// =======================
// CART COUNT (public - shop.js)
// =======================
Route::get('/cart/count', [CartController::class, 'count'])->name('cart.count');


// =======================
// AUTH ROUTES (Breeze/Jetstream/etc.)
// =======================
require __DIR__.'/auth.php';


// =======================
// SOCIAL LOGIN
// =======================
Route::get('/auth/google/redirect', [GoogleController::class, 'redirect'])->name('google.redirect');
Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('google.callback');

Route::get('/auth/facebook/redirect', [FacebookController::class, 'redirect'])->name('facebook.redirect');
Route::get('/auth/facebook/callback', [FacebookController::class, 'callback'])->name('facebook.callback');


// =======================
// AUTH REQUIRED
// =======================
Route::middleware('auth')->group(function () {

    // -------- PROFILE --------
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/profile/rewards', [ProfileController::class, 'rewards'])->name('profile.rewards');
    Route::post('/profile/rewards/redeem/{item}', [ProfileController::class, 'redeem'])->name('profile.redeem');

    Route::get('/profile/discounts', [ProfileController::class, 'discounts'])->name('profile.discounts');

    Route::get('/profile/security', [ProfileController::class, 'security'])->name('profile.security');
    Route::post('/profile/security', [ProfileController::class, 'updatePassword'])->name('profile.security.update');


    // -------- CART --------
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update/{product}', [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

    Route::post('/cart/discount/apply', [CartController::class, 'applyDiscount'])->name('cart.discount.apply');
    Route::post('/cart/discount/remove', [CartController::class, 'removeDiscount'])->name('cart.discount.remove');


    // -------- CHECKOUT --------
    Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout.show');
    Route::post('/checkout', [CheckoutController::class, 'place'])->name('checkout.place');
    Route::get('/checkout/quote', [CheckoutController::class, 'quote'])->name('checkout.quote');
    Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');


    // -------- ORDERS --------
    Route::get('/orders', [UserOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [UserOrderController::class, 'show'])->name('orders.show');
    Route::patch('/orders/{order}/cancel', [UserOrderController::class, 'cancel'])->name('orders.cancel');


    // -------- SETTINGS --------
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::put('/settings', [SettingsController::class, 'update'])->name('settings.update');

    
    Route::post('/settings/language', [SettingsController::class, 'updateLanguage'])->name('settings.language');
});


// =======================
// STRIPE / WEBHOOKS
// =======================
Route::post('/webhooks/stripe', [StripeWebhookController::class, 'handle']);

Route::post('/checkout/start/{order}', [CheckoutController::class, 'start']);
Route::get('/checkout/cancel', fn() => view('checkout.cancel'));


// =======================
// ADMIN
// =======================
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        Route::resource('users', UserController::class);
        Route::resource('products', ProductController::class);

        Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
        Route::put('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.status');

        // NOTIFICATIONS
        Route::get('/notifications', [NotificationsController::class, 'index'])->name('notifications.index');
        Route::post('/notifications/{notification}/read', [NotificationsController::class, 'markRead'])->name('notifications.read');
        Route::post('/notifications/read-all', [NotificationsController::class, 'markAllRead'])->name('notifications.readAll');
    });
