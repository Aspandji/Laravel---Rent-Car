<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SoftDeleteController;
use App\Http\Controllers\DashboardCarsController;
use App\Http\Controllers\DashboardRentController;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\DashboardCategoryController;
use App\Http\Controllers\DashboardReturnController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home', [
        'title' => 'Home',
        'active' => 'home'
    ]);
});


Route::controller(CarController::class)->group(function () {
    Route::get('/cars', 'index');
    Route::get('/form-rent', 'rent')->middleware('auth');
    Route::post('/form-rent', 'store')->middleware('auth');
});


// Auth Controller
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'login')->name('login')->middleware('guest');
    Route::post('/login', 'authenticate')->middleware('guest');
    Route::get('/register', 'register')->middleware('guest');
    Route::post('/register', 'store');
    Route::post('/logout', 'logout')->middleware('auth');
});

// Admin Controller
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'only_admin']);

Route::get('/dashboard/cars/trashed', [DashboardCarsController::class, 'trashed'])->name('cars.trashed')->middleware(['auth', 'only_admin']);
Route::get('/dashboard/cars/restore/{slug}', [DashboardCarsController::class, 'restore'])->name('cars.restore')->middleware(['auth', 'only_admin']);
Route::resource('/dashboard/cars', DashboardCarsController::class)->middleware(['auth', 'only_admin']);

Route::get('/dashboard/categories/trashed', [DashboardCategoryController::class, 'trashed'])->name('categories.trashed')->middleware(['auth', 'only_admin']);
Route::get('/dashboard/categories/restore/{slug}', [DashboardCategoryController::class, 'restore'])->name('categories.restore')->middleware(['auth', 'only_admin']);
Route::resource('/dashboard/categories', DashboardCategoryController::class)->middleware(['auth', 'only_admin']);

Route::get('/dashboard/users/trashed', [DashboardUserController::class, 'trashed'])->name('users.trashed')->middleware(['auth', 'only_admin']);
Route::get('/dashboard/users/restore/{slug}', [DashboardUserController::class, 'restore'])->name('users.restore')->middleware(['auth', 'only_admin']);
Route::resource('/dashboard/users', DashboardUserController::class)->middleware(['auth', 'only_admin']);

Route::resource('/dashboard/rent-logs', DashboardRentController::class)->middleware(['auth', 'only_admin']);

// Return Car
Route::controller(DashboardReturnController::class)->group(function () {
    Route::get('/dashboard/rent-return', 'index')->middleware(['auth', 'only_admin']);
    Route::post('/dashboard/rent-return', 'returnCar')->middleware(['auth', 'only_admin']);
});


// User Contoller
Route::controller(UserController::class)->group(function () {
    Route::get('/profile', 'index')->middleware(['auth', 'only_client']);
});
