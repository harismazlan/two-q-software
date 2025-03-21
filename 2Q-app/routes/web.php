<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;

// Redirect root to companies index
Route::get('/', function () {
    return redirect()->route('companies.index');
});

// Resource routes for companies with authentication middleware
Route::middleware(['auth'])->group(function () {
    Route::resource('companies', CompanyController::class);
});

// Include authentication routes
require __DIR__.'/auth.php';