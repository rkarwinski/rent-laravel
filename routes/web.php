<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InsurerController;
use App\Http\Controllers\InsurerValuesController;
use App\Http\Controllers\TrailerDimensionsController;
use App\Http\Controllers\TrailersController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\RentalsController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::resource('insurers', InsurerController::class);
    Route::resource('insurer_values', InsurerValuesController::class);
    Route::resource('trailer_dimensions', TrailerDimensionsController::class);
    Route::resource('trailers', TrailersController::class);
    Route::resource('customers', CustomersController::class);
    Route::resource('vehicles', VehicleController::class);
    Route::resource('addresses', AddressController::class);
    Route::resource('rentals', RentalsController::class);
    Route::get('/rentals/{id}/complete', [RentalsController::class, 'showCompleteForm'])->name('rentals.showCompleteForm');
    Route::put('/rentals/{id}/complete', [RentalsController::class, 'complete'])->name('rentals.complete');
    Route::get('/rentals/{id}/contract', [RentalsController::class, 'showContract'])->name('rentals.contract');
    Route::get('/rentals/{id}/download', [RentalsController::class, 'download'])->name('rentals.download');
    Route::get('/customers/view/ajax/document/{documentNumber}', [CustomersController::class, 'ajaxViewByDocument'])->name('customers.ajaxviewbydocument');
    Route::post('/ajax-view-available', [TrailersController::class, 'ajaxViewAvailable'])->name('trailers.ajaxViewAvailable');
    Route::get('cancel/{id}', [RentalsController::class, 'cancel'])->name('rentals.cancel');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

