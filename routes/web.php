<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
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
});


    // Admin Dashboard routes
    Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/dashboard', function () {
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
