<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ElementController;
use App\Http\Controllers\StepController;
use App\Http\Controllers\ChallengeController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Authenticated User Routes
Route::middleware('auth')->group(function () {
    // Profile Routes
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('profile.index');

        Route::prefix('settings')->name('profile.settings.')->group(function () {
            Route::get('/', [ProfileController::class, 'edit'])->name('edit');
            Route::patch('/', [ProfileController::class, 'update'])->name('update');
            Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
        });
    });

    // Elements
    Route::resource('elements', ElementController::class);

    // Not working ?
    Route::prefix('steps/{step_id}')->name('steps.')->group(function () {
        Route::get('upload-result', [StepController::class, 'uploadResult'])->name('uploadResult');
        Route::post('upload-result', [StepController::class, 'storeResult'])->name('storeResult');
    });

    Route::prefix('challenges')->name('challenges.')->group(function () {
        Route::get('/', [ChallengeController::class, 'index'])->name('index');

        Route::middleware(['auth', 'role:Admin'])->group(function () {
            Route::get('create', [ChallengeController::class, 'create'])->name('create');
            Route::post('/', [ChallengeController::class, 'store'])->name('store');
            Route::put('{id}/status', [ChallengeController::class, 'updateStatus'])->name('updateStatus');
            Route::get('{id}/edit', [ChallengeController::class, 'edit'])->name('edit');
            Route::put('{id}', [ChallengeController::class, 'update'])->name('update');
            Route::delete('{id}', [ChallengeController::class, 'destroy'])->name('destroy');
        });

        Route::get('{id}', [ChallengeController::class, 'show'])->name('show');
        Route::post('{id}/join', [ChallengeController::class, 'join'])->name('join');
        Route::post('{id}/complete', [ChallengeController::class, 'complete'])->name('complete');
    });
});

// Admin
Route::middleware(['auth', 'role:Admin'])->group(function () {
    // Step Routes (Nested under Elements)
    Route::prefix('elements/{element_id}/steps')->name('steps.')->group(function () {
        Route::get('create', [StepController::class, 'create'])->name('create');
        Route::post('/', [StepController::class, 'store'])->name('store');
    });

    Route::prefix('steps/{step_id}')->group(function () {
        Route::get('edit', [StepController::class, 'edit'])->name('steps.edit');
        Route::put('/', [StepController::class, 'update'])->name('steps.update');
        Route::delete('/', [StepController::class, 'destroy'])->name('steps.destroy');
    });

    // Admin dashboard
    Route::get('admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('admin/challenge-results', [AdminController::class, 'challengeResultsIndex'])->name('admin.challengeResults');
    Route::patch('admin/challenge-results/{result}', [AdminController::class, 'approveChallengeResult'])->name('admin.approveChallengeResult');
    Route::get('admin/element-results', [AdminController::class, 'elementResultsIndex'])->name('admin.elementResults');
    Route::patch('admin/element-results/{result}', [AdminController::class, 'approveElementResult'])->name('admin.approveElementResult');
});


// Include Auth Routes
require __DIR__ . '/auth.php';
