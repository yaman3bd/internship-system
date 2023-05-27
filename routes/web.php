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
    if (auth()->check()) {
        return redirect()->route('applications.index');
    } else {
        return view('welcome');
    }
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {


    Route::post('/upload', [\App\Http\Controllers\UploadController::class, 'store'])
         ->name('uploads.store');

    Route::delete('/upload', [\App\Http\Controllers\UploadController::class, 'destroy'])
         ->name('uploads.destroy');

    Route::get('/applications',
        [\App\Http\Controllers\ApplicationController::class, 'index'])->name('applications.index');

    Route::get('/applications/create',
        [\App\Http\Controllers\ApplicationController::class, 'create'])->name('applications.create');

    Route::get('/applications/{application}',
        [\App\Http\Controllers\ApplicationController::class, 'show'])->name('applications.show');

    Route::post('/applications', [\App\Http\Controllers\ApplicationController::class, 'store'])
         ->name('applications.store');
});
