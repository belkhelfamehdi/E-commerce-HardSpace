<?php

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

Route::get('send-sms', 'App\Http\Controllers\SMSController@sendSMS')->name('send-sms');

Route::get('product', function () {
    return view('frontend.frontend_layout.product');
})->name('product');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

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
