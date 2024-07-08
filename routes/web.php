<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PriceHistoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Models\PriceHistory;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Registro de Usuarios
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Inicio de Sesión
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Cierre de Sesión
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Restablecimiento de Contraseña
Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [ResetPasswordController::class, 'reset']);

// Verificación de Correo Electrónico (si está habilitada)
Route::get('/email/verify', [VerificationController::class, 'show'])->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
Route::get('/email/resend', [VerificationController::class, 'resend'])->name('verification.resend');
Route::get('/email/{id}/verify', [VerificationController::class, 'sendEmailVerification'])->name('verification.send');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'enabled'])->group(function () {

    Route::prefix('roles')->group(function () {
        //Route::resource('', UserController::class);
        Route::get('', [RoleController::class, 'index'])->name('roles.index');
        Route::get('{id}/show', [RoleController::class, 'show'])->name('roles.show');

        Route::get('create', [RoleController::class, 'create'])->name('roles.create');
        Route::post('store', [RoleController::class, 'store'])->name('roles.store');

        Route::get('{id}/edit', [RoleController::class, 'edit'])->name('roles.edit');
        Route::put('{id}/update', [RoleController::class, 'update'])->name('roles.update');

        Route::delete('{id}/destroy', [RoleController::class, 'destroy'])->name('roles.destroy');

        Route::get('{id}/permissions', [RoleController::class, 'editPermissions'])->name('roles.permissions');
        Route::patch('{id}/permissions', [RoleController::class, 'updatePermissions'])->name('roles.permissions');

        Route::get('datatable', [RoleController::class, 'dataTable'])->name('roles.datatable');
    });

    Route::prefix('permissions')->group(function () {
        Route::get('', [PermissionController::class, 'index'])->name('permissions.index');
        Route::get('{id}/show', [PermissionController::class, 'show'])->name('permissions.show');

        Route::get('create', [PermissionController::class, 'create'])->name('permissions.create');
        Route::post('store', [PermissionController::class, 'store'])->name('permissions.store');

        Route::get('{id}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
        Route::put('{id}/update', [PermissionController::class, 'update'])->name('permissions.update');

        Route::delete('{id}/destroy', [PermissionController::class, 'destroy'])->name('permissions.destroy');

        Route::get('datatable', [PermissionController::class, 'dataTable'])->name('permissions.datatable');
    });

    Route::prefix('users')->group(function () {
        //Route::resource('', UserController::class);
        Route::get('', [UserController::class, 'index'])->name('users.index');
        Route::get('{id}/show', [UserController::class, 'show'])->name('users.show');

        Route::get('create', [UserController::class, 'create'])->name('users.create');
        Route::post('store', [UserController::class, 'store'])->name('users.store');

        Route::get('{id}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('{id}/update', [UserController::class, 'update'])->name('users.update');

        Route::delete('{id}/destroy', [UserController::class, 'destroy'])->name('users.destroy');

        Route::get('{id}/roles', [UserController::class, 'editRoles'])->name('users.roles');
        Route::patch('{id}/roles', [UserController::class, 'updateRoles'])->name('users.roles');

        Route::get('{id}/password', [UserController::class, 'editPassword'])->name('users.password');
        Route::patch('{id}/password', [UserController::class, 'updatePassword'])->name('users.password');

        Route::patch('{id}/enable', [UserController::class, 'enable'])->name('users.enable');
        Route::patch('{id}/disable', [UserController::class, 'disable'])->name('users.disable');

        Route::get('datatable', [UserController::class, 'dataTable'])->name('users.datatable');
    });

    Route::prefix('products')->group(function () {
        Route::get('', [ProductController::class, 'index'])->name('products.index');
        Route::get('{id}/show', [ProductController::class, 'show'])->name('products.show');

        Route::get('create', [ProductController::class, 'create'])->name('products.create');
        Route::post('store', [ProductController::class, 'store'])->name('products.store');

        Route::get('{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('{id}/update', [ProductController::class, 'update'])->name('products.update');

        Route::delete('{id}/destroy', [ProductController::class, 'destroy'])->name('products.destroy');

        Route::patch('{id}/prices/new', [PriceHistoryController::class, 'newProductPrice'])->name('products.prices.new');
        Route::get('prices/{id}/edit', [PriceHistoryController::class, 'edit'])->name('products.prices.edit');
        Route::put('prices/{id}/update', [PriceHistoryController::class, 'update'])->name('products.prices.update');
        Route::delete('prices/{id}/destroy', [PriceHistoryController::class, 'destroy'])->name('products.prices.destroy');

        Route::get('datatable', [ProductController::class, 'dataTable'])->name('products.datatable');
    });

    Route::prefix('clients')->group(function () {
        Route::get('', [ClientController::class, 'index'])->name('clients.index');
        Route::get('{id}/show', [ClientController::class, 'show'])->name('clients.show');

        Route::get('create', [ClientController::class, 'create'])->name('clients.create');
        Route::post('store', [ClientController::class, 'store'])->name('clients.store');

        Route::get('{id}/edit', [ClientController::class, 'edit'])->name('clients.edit');
        Route::put('{id}/update', [ClientController::class, 'update'])->name('clients.update');

        Route::delete('{id}/destroy', [ClientController::class, 'destroy'])->name('clients.destroy');

        Route::get('datatable', [ClientController::class, 'dataTable'])->name('clients.datatable');
    });

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('password/edit', [PasswordController::class, 'edit'])->name('password.edit');
    Route::patch('password/update', [PasswordController::class, 'update'])->name('password.update');

    Route::get('profile', function () {
        return view('profile');
    });
});

Route::get('example', function () {
    $product = Product::find(1013);
    $price_history = $product->priceHistory;
    return view('example', compact('product', 'price_history'));
})->name('example');

Route::get('/disabled', function () {
    return view('auth.disabled');
})->name('auth.disabled');



