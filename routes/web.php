<?php

use App\Http\Livewire\Clients\CustomFields;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StaffController;
use App\Models\Client;
use App\Models\Staff;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/contacts', function () {
    return view('contacts', [
        'clients' => Client::orderBy('full_name')->paginate(12),
        'staff' => Staff::orderBy('full_name')->paginate(12)        
    ]);
})->name('contacts');

Route::get('/clients/{client}/custom_fields', CustomFields::class)
    ->middleware('can:update,client')
    ->name('clients.custom_fields');
    
Route::resource('clients', ClientController::class)->except(['index']);

Route::resource('staff', StaffController::class)->except(['index']);