<?php

use Illuminate\Support\Facades\Route;
<<<<<<< HEAD
<<<<<<< HEAD
=======

>>>>>>> fc7673c (frontend update and some new feature)
=======

>>>>>>> 5c55d34 (new features)
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AdviceController;
use App\Http\Controllers\OrderController as UserOrderController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\FacebookController;
<<<<<<< HEAD
<<<<<<< HEAD
=======

>>>>>>> fc7673c (frontend update and some new feature)
=======

>>>>>>> 5c55d34 (new features)
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ProductController;
<<<<<<< HEAD
<<<<<<< HEAD
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\StripeWebhookController;
use App\Http\Controllers\SettingsController;



Route::get('/', fn () => view('welcome'))->name('home');


=======
=======
>>>>>>> 5c55d34 (new features)

use App\Http\Controllers\ExercisesController;
use App\Http\Controllers\StripeWebhookController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\Admin\NotificationsController;
<<<<<<< HEAD
=======
use App\Http\Controllers\NewsletterController;
>>>>>>> 5c55d34 (new features)


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

<<<<<<< HEAD
=======
// =======================
// EMAIL->subscribe button
// =======================
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');
>>>>>>> 5c55d34 (new features)

// =======================
// DASHBOARD (auth + verified)
// =======================
<<<<<<< HEAD
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
Route::get('/dashboard', fn () => view('dashboard'))
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


// =======================
<<<<<<< HEAD
<<<<<<< HEAD
// PROFILE (auth required)
// =======================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/rewards', [ProfileController::class, 'rewards'])->name('profile.rewards');
    Route::get('/profile/discounts', [ProfileController::class, 'discounts'])->name('profile.discounts');
    Route::post('/profile/rewards/redeem/{item}', [ProfileController::class, 'redeem'])->name('profile.redeem');
    Route::get('/profile/security', [ProfileController::class, 'security'])->name('profile.security');
    Route::post('/profile/security', [ProfileController::class, 'updatePassword'])->name('profile.security.update');
});



// =======================
// STORE – public
// =======================
Route::get('/store', [StoreController::class, 'index'])->name('store.index');


// =======================
// CART + CHECKOUT
// =======================

// 🔹 KOSÁR DARABSZÁM – shop.js miatt **PUBLIKUS**
Route::get('/cart/count', [CartController::class, 'count'])->name('cart.count');

// 🔹 TÖBBI KOSÁRMŰVELET – csak belépve
Route::middleware('auth')->group(function () {

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');

    Route::post('/cart/update/{product}', [CartController::class, 'update'])->name('cart.update');

    Route::post('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');

    Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

    Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout.show');
    Route::post('/checkout', [CheckoutController::class, 'place'])->name('checkout.place');
  

    Route::post('/cart/discount/apply', [CartController::class, 'applyDiscount'])->name('cart.discount.apply');

    Route::post('/cart/discount/remove', [CartController::class, 'removeDiscount'])->name('cart.discount.remove');

});


// =======================
// ADVICE – public
// =======================
Route::get('/advice', [AdviceController::class, 'index'])->name('advice.index');
Route::post('/advice/bmi', [AdviceController::class, 'calculateBMI'])->name('advice.bmi');

=======
=======
>>>>>>> 5c55d34 (new features)
// CART COUNT (public - shop.js)
// =======================
Route::get('/cart/count', [CartController::class, 'count'])->name('cart.count');


// =======================
// AUTH ROUTES (Breeze/Jetstream/etc.)
// =======================
<<<<<<< HEAD
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
require __DIR__.'/auth.php';


// =======================
<<<<<<< HEAD
<<<<<<< HEAD
// GOOGLE LOGIN
// =======================
Route::get('/auth/google/redirect', [GoogleController::class, 'redirect'])
    ->name('google.redirect');

Route::get('/auth/google/callback', [GoogleController::class, 'callback'])
    ->name('google.callback');


// =======================
// FACEBOOK LOGIN
// =======================
Route::get('/auth/facebook/redirect', [FacebookController::class, 'redirect'])
    ->name('facebook.redirect');

Route::get('/auth/facebook/callback', [FacebookController::class, 'callback'])
    ->name('facebook.callback');


// =======================
// ORDERS (auth required)
// =======================
Route::middleware(['auth'])->group(function () {
     Route::get('/orders', [UserOrderController::class, 'index'])
        ->name('orders.index');
    Route::get('/orders/{order}', [UserOrderController::class, 'show'])
        ->name('orders.show');
=======
=======
>>>>>>> 5c55d34 (new features)
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


    // -------- SETTINGS --------
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::put('/settings', [SettingsController::class, 'update'])->name('settings.update');

    
    Route::post('/settings/language', [SettingsController::class, 'updateLanguage'])->name('settings.language');
<<<<<<< HEAD
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
});


// =======================
<<<<<<< HEAD
<<<<<<< HEAD
=======
=======
>>>>>>> 5c55d34 (new features)
// STRIPE / WEBHOOKS
// =======================
Route::post('/webhooks/stripe', [StripeWebhookController::class, 'handle']);

// Ha ezt is auth mögé akarod tenni, szólj — most meghagytam úgy, ahogy nálad volt.
Route::post('/checkout/start/{order}', [CheckoutController::class, 'start']);
Route::get('/checkout/cancel', fn() => view('checkout.cancel'));


// =======================
<<<<<<< HEAD
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
// ADMIN
// =======================
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
<<<<<<< HEAD
<<<<<<< HEAD
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::resource('users', UserController::class);
        Route::resource('products', ProductController::class);
        Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
        Route::put('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.status');
    });

// =======================
// EXERCISE
// =======================
Route::get('/exercises', [ExerciseController::class, 'index'])->name('exercises.index');

// =======================
// SETTINGS
// =======================
Route::middleware('auth')->group(function () {
    Route::get('/settings', function () {
        return view('settings.index');
    })->name('settings.index');
});

// =======================
// REWARDS
// =======================
Route::get('/profile/rewards', [ProfileController::class, 'rewards'])->name('profile.rewards');
Route::post('/profile/rewards/redeem/{item}', [ProfileController::class, 'redeem'])->name('profile.redeem');
Route::get('/profile/discounts', [ProfileController::class, 'discounts'])->name('profile.discounts');

// =======================
// STRIPEWEB-Paying
// =======================
Route::post('/webhooks/stripe', [StripeWebhookController::class, 'handle']);
Route::post('/checkout/start/{order}', [CheckoutController::class, 'start']);
Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
Route::get('/checkout/cancel', fn() => view('checkout.cancel'));

// =======================
// SETTINGS
// =======================
Route::middleware('auth')->group(function () {
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::put('/settings', [SettingsController::class, 'update'])->name('settings.update');
});

=======
=======
>>>>>>> 5c55d34 (new features)

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
<<<<<<< HEAD
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
