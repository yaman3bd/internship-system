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
        return redirect()->route('applications.index', [
            'type' => 'official_letter_request'
        ]);
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


    Route::get('/messages',
        [\App\Http\Controllers\MessageController::class, 'index'])->name('messages.index');

    Route::get('/messages/create',
        [\App\Http\Controllers\MessageController::class, 'create'])->name('messages.create');

    Route::get('/messages/{message}',
        [\App\Http\Controllers\MessageController::class, 'show'])->name('messages.show');

    Route::post('/messages', [\App\Http\Controllers\MessageController::class, 'store'])
         ->name('messages.store');

    Route::post('/messages/{message}/reply', [\App\Http\Controllers\MessageController::class, 'reply'])
         ->name('messages.reply');

    Route::get('/announcements',
        [\App\Http\Controllers\AnnouncementController::class, 'index'])->name('announcements.index');
    Route::get('/announcements/{message}',
        [\App\Http\Controllers\AnnouncementController::class, 'show'])->name('announcements.show');
});
