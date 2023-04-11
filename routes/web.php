<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\frontend\ProductsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Auth\Access\AuthorizationException;
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

Route::get('/', function () {
    return view('frontend.index');
})->name('index');

Route::get('store', function () {
    return view('frontend.frontend_layout.store');
})->name('store');
Route::get('/store',[ProductsController::class, 'index'])->name('store');

Route::get('product', function () {
    return view('frontend.frontend_layout.product');
})->name('product');

Route::group(['prefix'=> 'admin', 'middleware'=>['admin:admin']], function(){
	Route::get('/1wire_rty/login',[AdminController::class, 'loginForm']);
	Route::post('/login',[AdminController::class, 'store'])->name('admin.login');
});

Route::middleware(['auth:admin'])->group(function(){

    // Admin Logout/password change and profile routes
    Route::prefix('/admin')->group(function () {
        Route::get('/logout',[AdminController::class, 'destroy'])->name('admin.logout');
    });

    // Admin Products routes
    Route::prefix('/admin')->group(function () {
        Route::get('/products', [ProductController::class, 'index'])->name('admin.products');
        Route::post('/products/search', [ProductController::class, 'SearchProduct'])->name('search.products');
        Route::get('/products/create', [ProductController::class, 'create'])->name('admin.products.create');
        Route::post('/products/store', [ProductController::class, 'store'])->name('admin.products.store');
        Route::delete('/products/delete/{id}', [ProductController::class, 'destroy'])->name('admin.products.destroy');
        Route::get('/products/edit/{id}', [ProductController::class, 'edit'])->name('admin.products.edit');
        Route::put('/products/update/{id}', [ProductController::class, 'update'])->name('admin.products.update');
    });

    // Admin Category routes
    Route::prefix('/admin')->group(function () {
        Route::get('/category', [CategoryController::class, 'index'])->name('admin.category');
        Route::post('/category/search', [CategoryController::class, 'SearchCategory'])->name('search.category');
        Route::get('/category/create', [CategoryController::class, 'create'])->name('admin.category.create');
        Route::post('/category/store', [CategoryController::class, 'store'])->name('admin.category.store');
        Route::delete('/category/delete/{id}', [CategoryController::class, 'destroy'])->name('admin.category.destroy');
        Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('admin.category.edit');
        Route::put('/category/update/{id}', [CategoryController::class, 'update'])->name('admin.category.update');
    });


    // Admin Dashboard routes
    Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/dashboard', function () {
        if (auth()->check() && auth()->user()->getTable() == 'users') {
            throw new AuthorizationException('Vous n\'êtes pas autorisé.');
        }
        return view('admin.index');
    })->name('admin.dashboard');


$authMiddleware = config('jetstream.guard')
? 'auth:'.config('jetstream.guard')
: 'auth';

$authSessionMiddleware = config('jetstream.auth_session', false)
? config('jetstream.auth_session')
: null;

Route::group(['middleware' => array_values(array_filter([$authMiddleware, $authSessionMiddleware]))], function () {
    Route::view('/user/change-password', 'profile.update-password')->name('profile.update-password');
    Route::view('/user/security', 'profile.security')->name('profile.security');
    Route::view('/user/delete-profile', 'profile.delete-profile')->name('profile.delete-profile');
});
});