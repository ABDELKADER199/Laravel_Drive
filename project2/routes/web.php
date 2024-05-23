<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DriveController;
use App\Http\Controllers\ProfileController;
use App\Models\Category;
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
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// middleware for Category

Route::middleware('auth')->group(function () {
    Route::prefix('category')->name('category.')->group(function () {

        Route::get("index", [CategoryController::class, 'index'])->name('index');
        Route::get("create", [CategoryController::class, 'create'])->name('create');
        Route::post("store", [CategoryController::class, 'store'])->name('store');
        Route::get("edit/{id}", [CategoryController::class, 'edit'])->name('edit');
        Route::post("update/{id}", [CategoryController::class, 'update'])->name('update');
        Route::get("destroy/{id}", [CategoryController::class, 'destroy'])->name('destroy');
    });
});
// middleware for Drive
Route::middleware('auth')->group(function () {
    Route::prefix('drive')->name('drive.')->group(function () {
        Route::get("index", [DriveController::class, 'index'])->name('index');
        Route::get("create", [DriveController::class, 'create'])->name('create');
        Route::post("store", [DriveController::class, 'store'])->name('store');
        Route::get("edit/{id}", [DriveController::class, 'edit'])->name('edit');
        Route::post("update/{id}", [DriveController::class, 'update'])->name('update');
        Route::get("destroy/{id}", [DriveController::class, 'destroy'])->name('destroy');
        Route::get("show/{id}", [DriveController::class, 'show'])->name('show');
        Route::get('publicDrive',[DriveController::class , 'publicDrive'] )->name('public');
        Route::get('changeStatus/{id}',[DriveController::class , 'changeStatus'] )->name('changeStatus');

    });
});

Route::get('/register', function () {
    return view('auth.register');
});



require __DIR__ . '/auth.php';
