<?php

use App\Http\Livewire\Clients\CustomFields;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\StaffController;
use App\Http\Livewire\Settings\CreateFunnel;
use App\Http\Livewire\Settings\CreateRole;
use App\Http\Livewire\Settings\EditFunnel;
use App\Http\Livewire\Settings\EditRole;
use App\Http\Livewire\Settings\SettingsPage;
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

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('/contacts', function () {
        return view('contacts', [
            'clients' => Client::orderBy('full_name')->paginate(12, ['*'], 'clientsPage'),
            'staff' => Staff::orderBy('full_name')->paginate(12, ['*'], 'staffPage')        
        ]);
    })->name('contacts');
    
    Route::get('/clients/{client}/custom_fields', CustomFields::class)
        ->middleware('can:update,client')
        ->name('clients.custom_fields');
        
    Route::resource('clients', ClientController::class)->except(['index']);
    
    Route::resource('staff', StaffController::class)->except(['index']);
    
    Route::prefix('settings')->group(function () {
        Route::get('/', SettingsPage::class)->name('settings');
        Route::get('/funnels/create', CreateFunnel::class)->name('funnels.create');
        Route::get('/funnels/{funnel}/edit', EditFunnel::class)->name('funnels.edit');

        Route::get('/roles/create', CreateRole::class)->name('roles.create');
        Route::get('/roles/{role}/edit', EditRole::class)->name('roles.edit');
    });
});