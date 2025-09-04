<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\SongController;
use App\Http\Controllers\ChatController;

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
    'verified',
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Information routes
    Route::resource('information', InformationController::class);
    
    // Song routes - Multi-step creation
    Route::get('/songs', [SongController::class, 'index'])->name('songs.index');
    Route::get('/songs/create', [SongController::class, 'create'])->name('songs.create');
    Route::post('/songs/step1', [SongController::class, 'storeStep1'])->name('songs.store-step1');
    Route::get('/songs/create-step2', [SongController::class, 'createStep2'])->name('songs.create-step2');
    Route::post('/songs/step2', [SongController::class, 'storeStep2'])->name('songs.store-step2');
    Route::get('/songs/create-step3', [SongController::class, 'createStep3'])->name('songs.create-step3');
    Route::post('/songs/step3', [SongController::class, 'storeStep3'])->name('songs.store-step3');
    Route::get('/songs/create-step4', [SongController::class, 'createStep4'])->name('songs.create-step4');
    Route::post('/songs/step4', [SongController::class, 'storeStep4'])->name('songs.store-step4');
    Route::get('/songs/create-step5', [SongController::class, 'createStep5'])->name('songs.create-step5');
    Route::post('/songs/step5', [SongController::class, 'storeStep5'])->name('songs.store-step5');
    Route::get('/songs/create-step6', [SongController::class, 'createStep6'])->name('songs.create-step6');
    Route::post('/songs', [SongController::class, 'store'])->name('songs.store');
    Route::get('/songs/{song}/edit', [SongController::class, 'edit'])->name('songs.edit');
    Route::put('/songs/{song}', [SongController::class, 'update'])->name('songs.update');
    Route::patch('/songs/{song}/status', [SongController::class, 'updateStatus'])->name('songs.updateStatus');
    Route::get('/bahan-lagu', [SongController::class, 'bahanLagu'])->name('songs.bahanLagu');
    
    // Chat routes
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::post('/chat', [ChatController::class, 'store'])->name('chat.store');
});
