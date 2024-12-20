<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NotificationController;

Auth::routes();

// Auth
Route::middleware(['auth'])->group(function () {
    // Logout
    Route::get('/custom_logout', [HomeController::class, 'custom_logout'])->name('custom_logout');

    // App
    Route::prefix('app')->group(function () {
        // Users
        Route::prefix('users')->group(function () {
            Route::get('/export', [UserController::class, 'export'])->name('users.export');
            Route::get('/new', [UserController::class, 'new'])->name('users.new');
            Route::post('/create', [UserController::class, 'create'])->name('users.create');
            Route::get('/edit/{user}', [UserController::class, 'edit'])->name('users.edit');
            Route::post('/update/{user}', [UserController::class, 'update'])->name('users.update');
            Route::get('/delete/{user}', [UserController::class, 'destroy'])->name('users.destroy');
            Route::get('/', [UserController::class, 'index'])->name('users');
        });

        // Logs
        Route::prefix('logs')->group(function () {
            Route::get('/export', [LogController::class, 'export'])->name('logs.export');
            Route::get('/fetch', [LogController::class, 'fetch'])->name('logs.fetch');
            Route::get('/', [LogController::class, 'index'])->name('logs');
        });

        // Notifications
        Route::prefix('notifications')->group(function () {
            Route::get('/fetch', [NotificationController::class, 'fetch'])->name('notifications.fetch');
            Route::get('/', [NotificationController::class, 'index'])->name('notifications');
        });

        // Categories
        Route::prefix('categories')->group(function () {
            Route::get('/export', [CategoryController::class, 'export'])->name('categories.export');
            Route::get('/new', [CategoryController::class, 'new'])->name('categories.new');
            Route::post('/create', [CategoryController::class, 'create'])->name('categories.create');
            Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
            Route::post('/{category}/update', [CategoryController::class, 'update'])->name('categories.update');
            Route::get('/{category}/destroy', [CategoryController::class, 'destroy'])->name('categories.destroy');
            Route::get('/', [CategoryController::class, 'index'])->name('categories');
        });

        // Products
        Route::prefix('products')->group(function () {
            Route::get('/export', [ProductController::class, 'export'])->name('products.export');
            Route::get('/new', [ProductController::class, 'new'])->name('products.new');
            Route::post('/create', [ProductController::class, 'create'])->name('products.create');
            Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
            Route::post('/{product}/update', [ProductController::class, 'update'])->name('products.update');
            Route::get('/{product}/import', [ProductController::class, 'import'])->name('products.import');
            Route::post('/{product}/save', [ProductController::class, 'save'])->name('products.save');
            Route::get('/{product}/destroy', [ProductController::class, 'destroy'])->name('products.destroy');
            Route::get('/{product}/images', [ProductController::class, 'images'])->name('products.images');
            Route::post('/{product}/upload', [ProductController::class, 'upload'])->name('products.upload');
            Route::get('/secondary_images/{secondary_image}/destroy', [ProductController::class, 'clean'])->name('secondary_images.destroy');
            Route::get('/', [ProductController::class, 'index'])->name('products');
        });

        // Orders
        Route::prefix('orders')->group(function () {
            Route::get('/export', [OrderController::class, 'export'])->name('orders.export');
            Route::get('/new', [OrderController::class, 'new'])->name('orders.new');
            Route::post('/create', [OrderController::class, 'create'])->name('orders.create');
            Route::get('/{order}/edit', [OrderController::class, 'edit'])->name('orders.edit');
            Route::post('/{order}/update', [OrderController::class, 'update'])->name('orders.update');
            Route::get('/{order}/destroy', [OrderController::class, 'destroy'])->name('orders.destroy');
            Route::get('/{order}/show', [OrderController::class, 'show'])->name('orders.show');
            Route::get('/', [OrderController::class, 'index'])->name('orders');
        });

        // Dashboard
        Route::get('/', [AppController::class, 'index'])->name('app');
    });
});

Route::middleware(['setLocale'])->group(function () {
    // Preferences
    Route::post('/preferences', [HomeController::class, 'preferences'])->name('preferences');

    // Search
    Route::get('/search/products', [HomeController::class, 'search'])->name('products.search');

    //Frontend
    Route::get('/about', [App\Http\Controllers\HomeController::class, 'about'])->name('about');

    Route::get('/contact', [App\Http\Controllers\HomeController::class, 'contact'])->name('contact');
    Route::post('/contact/send', [App\Http\Controllers\HomeController::class, 'send'])->name('contact.send');

    Route::get('/shop', [App\Http\Controllers\HomeController::class, 'shop'])->name('shop');
    Route::get('/product/{product:name}', [App\Http\Controllers\HomeController::class, 'product'])->name('product');

    Route::get('/checkout', [App\Http\Controllers\HomeController::class, 'checkout'])->name('checkout');
    Route::post('/checkout/order', [App\Http\Controllers\HomeController::class, 'order'])->name('order');

    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});
