<?php

use App\Http\Livewire\Clients\CustomFields as ClientsCustomFields;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DealController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\TaskController;
use App\Http\Livewire\Deals\CustomFields as DealsCustomFields;
use App\Http\Livewire\Deals\Index as DealsIndex;
use App\Http\Livewire\Deals\Show as DealsShow;
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
    Route::resource('tasks', TaskController::class)->except(['show']);

    Route::resource('deals', DealController::class)->only(['create', 'store', 'destroy']);
    Route::get('/deals', DealsIndex::class)->name('deals.index');
    Route::get('/deals/{deal}', DealsShow::class)->name('deals.show');
    Route::get('/deals/{deal}/custom_fields', DealsCustomFields::class)
        ->middleware('can:update,deal')
        ->name('deals.custom_fields');

    Route::get('/contacts', function () {
        return view('contacts', [
            'clients' => Client::orderBy('full_name')->paginate(12, ['*'], 'clientsPage'),
            'staff' => Staff::orderBy('full_name')->paginate(12, ['*'], 'staffPage')        
        ]);
    })->name('contacts');
    
    Route::get('/clients/{client}/custom_fields', ClientsCustomFields::class)
        ->middleware('can:update,client')
        ->name('clients.custom_fields');
        
    Route::resource('clients', ClientController::class)->except(['index']);    
    Route::resource('staff', StaffController::class)->except(['index']);
    
    Route::prefix('settings')->group(function () {
        Route::get('/', SettingsPage::class)->name('settings');

        Route::get('/funnels/create', CreateFunnel::class)
            ->middleware('can:add funnel')
            ->name('funnels.create');            
            
        Route::get('/funnels/{funnel}/edit', EditFunnel::class)
            ->middleware('can:edit funnel')
            ->name('funnels.edit');

        Route::get('/roles/create', CreateRole::class)
            ->middleware('can:add role')
            ->name('roles.create');

        Route::get('/roles/{role}/edit', EditRole::class)
            ->middleware('can:edit role')
            ->name('roles.edit');
    });
});