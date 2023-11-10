<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\UsersController;
use App\Models\Partner;
use Illuminate\Support\Facades\Auth;
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

Route::domain('admin.digisplix.test')
    // ->middleware('staff')
    ->name('staff.')
    ->group(function () {
        Route::get('/', [StaffController::class, 'index'])
            ->name('index');
    });

Route::domain('partner.digisplix.test')
    ->name('partner.')
    ->group(function () {
        Route::get('/', [PartnerController::class, 'index'])
            ->name('index');
    });

Route::resource('users', UsersController::class);

Auth::routes();
