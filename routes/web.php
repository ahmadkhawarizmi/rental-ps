
<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\RentalTransactionController;
use Illuminate\Support\Facades\Route;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Vehicle;
use App\Models\RentalTransaction;

// Halaman utama
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Semua halaman yang membutuhkan login
Route::middleware(['auth'])->group(function () {

   Route::get('/dashboard', function () {
    $totalCategories = Category::count();
    $totalCustomers = Customer::count();
    $totalVehicles = Vehicle::count();
    $totalTransactions = RentalTransaction::count();

    return view('dashboard', compact(
        'totalCategories',
        'totalCustomers',
        'totalVehicles',
        'totalTransactions'
    ));
})->middleware('auth')->name('dashboard');

    // Categories
    Route::resource('categories', CategoryController::class);

    // Customers
    Route::resource('customers', CustomerController::class);

    // Vehicles
    Route::resource('vehicles', VehicleController::class);

    // Rental Transactions
    Route::resource('rental-transactions', RentalTransactionController::class);

    // Proses pengembalian kendaraan
    Route::post(
        '/rental-transactions/{rental_transaction}/return',
        [RentalTransactionController::class, 'processReturn']
    )->name('rental-transactions.return');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

});

// Authentication Breeze
require __DIR__.'/auth.php';
