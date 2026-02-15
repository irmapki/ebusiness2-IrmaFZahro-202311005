<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    ProfileController,
    AdminController,
    UserDashboardController,
    ShopController,
    CartController,
    OrderController,
    WishlistController,
    CheckoutController
};
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\AdminOrderController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::view('/', 'welcome');

/*
|--------------------------------------------------------------------------
| Dashboard Redirect by Role
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    return auth()->user()->isAdmin()
        ? redirect()->route('admin.dashboard')
        : redirect()->route('user.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Authenticated User Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // USER DASHBOARD
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');

        Route::controller(ProfileController::class)->group(function () {
            Route::get('/profile', 'edit')->name('profile.edit');
            Route::patch('/profile', 'update')->name('profile.update');
            Route::delete('/profile', 'destroy')->name('profile.destroy');
        });
    });

    // SHOP
    Route::prefix('shop')->name('shop.')->controller(ShopController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{product}', 'show')->name('show');
    });

    // CART
    Route::prefix('cart')->name('cart.')->controller(CartController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/add/{product}', 'add')->name('add');
        Route::patch('/update/{cartItem}', 'update')->name('update');
        Route::delete('/remove/{cartItem}', 'remove')->name('remove');
        Route::delete('/clear', 'clear')->name('clear');
    });

    // WISHLIST
    Route::prefix('wishlist')->name('wishlist.')->controller(WishlistController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/add/{product}', 'add')->name('add');
        Route::delete('/remove/{product}', 'remove')->name('remove');
    });

    // USER ORDERS (Customer Side)
    Route::prefix('orders')->name('orders.')->controller(OrderController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{order}', 'show')->name('show');
        Route::get('/{order}/print', 'print')->name('print');
        Route::put('/{order}/cancel', 'cancel')->name('cancel');
        Route::patch('/{order}/confirm-delivery', 'confirmDelivery')->name('confirm-delivery'); // ✅ BARU
    });

    // CHECKOUT
    Route::prefix('checkout')->name('checkout.')->controller(CheckoutController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'process')->name('process');
    });

});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        // ADMIN PROFILE
        Route::controller(ProfileController::class)->group(function () {
            Route::get('/profile', 'edit')->name('profile.edit');
            Route::patch('/profile', 'update')->name('profile.update');
            Route::delete('/profile', 'destroy')->name('profile.destroy');
        });

        // USERS MANAGEMENT
        Route::controller(AdminController::class)->group(function () {
            Route::get('/users', 'index')->name('users.index');
            Route::get('/users/create', 'create')->name('users.create');
            Route::post('/users', 'store')->name('users.store');
            Route::get('/users/{user}/edit', 'edit')->name('users.edit');
            Route::put('/users/{user}', 'update')->name('users.update');
            Route::delete('/users/{user}', 'destroy')->name('users.destroy');
        });

        // ADMIN PRODUCTS
        Route::resource('products', AdminProductController::class)->except(['show']);

        // ADMIN ORDERS MANAGEMENT
        Route::prefix('orders')->name('orders.')->controller(AdminOrderController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/{order}', 'show')->name('show');
            Route::patch('/{order}/status', 'updateStatus')->name('update-status');
            Route::get('/{order}/print', 'print')->name('print');
            Route::delete('/{order}', 'destroy')->name('destroy');
        });

        // NOTIFICATIONS
        Route::prefix('notifications')->name('notifications.')->controller(NotificationController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/{id}/read', 'markAsRead')->name('markAsRead');
            Route::post('/mark-all-read', 'markAllAsRead')->name('markAllAsRead');
            Route::delete('/{id}', 'destroy')->name('destroy');
            Route::post('/delete-all-read', 'deleteAllRead')->name('deleteAllRead');
        });
    });

require __DIR__ . '/auth.php';