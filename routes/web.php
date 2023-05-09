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
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {

    Route::get('/dashboard', function () {
        $applications = collect([
            [
                'id' => 1,
                'name' => 'John Doe',
            ]
        ]);

        return view('dashboard', compact('applications'));
    })->name('dashboard');

    Route::post('/upload', [\App\Http\Controllers\UploadController::class, 'store'])
         ->name('uploads.store');

    Route::delete('/upload', [\App\Http\Controllers\UploadController::class, 'destroy'])
         ->name('uploads.destroy');

    Route::post('/applications', [\App\Http\Controllers\ApplicationController::class, 'store'])
         ->name('applications.store');
});
