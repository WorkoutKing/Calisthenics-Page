<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BasicController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ElementController;
use App\Http\Controllers\StepController;
use App\Http\Controllers\ChallengeController;
use App\Http\Controllers\AchievementsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\PostController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\HomeController;

// Public Routes
Route::get('/', action: [HomeController::class, 'index'])->name('welcome');
Route::get('/elements', action: [ElementController::class, 'index'])->name('elements.index');
Route::get('/elements/statistics', [ElementController::class, 'statistics'])->name('elements.statistics');
Route::get('/basics/statistics', action: [BasicController::class, 'statistics'])->name('basics.statistics');
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
Route::get('/challenges', [ChallengeController::class, 'index'])->name('challenges.index');
Route::get('/challenges/{id}', [ChallengeController::class, 'show'])->name('challenges.show');
Route::get('/profile/{userId}', [ProfileController::class, 'otherUserProfile'])->name('profile.other');

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

    // Achievements
    Route::get('/achievements', [AchievementsController::class, 'index'])->name('achievements.index');

    // Basics
    Route::get('/basics', [BasicController::class, 'index'])->name('basics.index');
    Route::post('/basics', [BasicController::class, 'upload'])->name('basics.upload');

    // Elements
    Route::get('/elements/create', [ElementController::class, 'create'])->name('elements.create');
    Route::post('/elements', [ElementController::class, 'store'])->name('elements.store');

    // Not working ?
    Route::prefix('steps/{step_id}')->name('steps.')->group(function () {
        Route::get('upload-result', [StepController::class, 'uploadResult'])->name('uploadResult');
        Route::post('upload-result', [StepController::class, 'storeResult'])->name('storeResult');
    });

    // Steps deletion by user
    Route::delete('/steps/{step_id}/delete-result', [StepController::class, 'destroyResult'])->name('steps.destroyResult');
    Route::get('/profile/notifications', [ProfileController::class, 'notifications'])->name('profile.notifications');
    Route::patch('/notifications/markAsRead', [ProfileController::class, 'markAsRead'])->name('profile.markAsRead');
    Route::delete('/profile/notifications/clear', [ProfileController::class, 'clearNotifications'])->name('profile.clearNotifications');
    Route::patch('/profile/notifications/{id}/mark-as-read', [ProfileController::class, 'markAsReadSingle'])->name('profile.markAsReadSingle');

    Route::prefix('challenges')->name('challenges.')->group(function () {
        Route::middleware(['auth', 'role:Admin'])->group(function () {
            Route::get('create', [ChallengeController::class, 'create'])->name('create');
            Route::post('/', [ChallengeController::class, 'store'])->name('store');
            Route::put('{id}/status', [ChallengeController::class, 'updateStatus'])->name('updateStatus');
            Route::get('{id}/edit', [ChallengeController::class, 'edit'])->name('edit');
            Route::put('{id}', [ChallengeController::class, 'update'])->name('update');
            Route::delete('{id}', [ChallengeController::class, 'destroy'])->name('destroy');
        });

        Route::post('{id}/join', [ChallengeController::class, 'join'])->name('join');
        Route::post('{id}/complete', [ChallengeController::class, 'complete'])->name('complete');
    });
});

// Admin
Route::middleware(['auth', 'role:Admin'])->group(function () {
    // Quote Routes
    Route::get('admin/quotes', [QuoteController::class, 'index'])->name('admin.quotes.index');
    Route::get('admin/quotes/create', [QuoteController::class, 'create'])->name('admin.quotes.create');
    Route::post('admin/quotes', [QuoteController::class, 'store'])->name('admin.quotes.store');
    Route::get('admin/quotes/{quote}/edit', [QuoteController::class, 'edit'])->name('admin.quotes.edit');
    Route::put('admin/quotes/{quote}', [QuoteController::class, 'update'])->name('admin.quotes.update');
    Route::delete('admin/quotes/{quote}', [QuoteController::class, 'destroy'])->name('admin.quotes.destroy');

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

    // Elements
    Route::get('admin/element-results', [AdminController::class, 'elementResultsIndex'])->name('admin.elementResults');
    Route::patch('admin/element-results/{result}', [AdminController::class, 'approveElementResult'])->name('admin.approveElementResult');
    Route::delete('/delete-element-result/{result}', [AdminController::class, 'deleteElementResult'])->name('admin.deleteElementResult');

    // Challenges
    Route::get('admin/challenge-results', [AdminController::class, 'challengeResultsIndex'])->name('admin.challengeResults');
    Route::patch('/admin/challenge-results/{challengeResult}/approve', [AdminController::class, 'approveChallengeResult'])->name('admin.approveChallengeResult');
    Route::delete('/admin/challenge-results/{challengeResult}', [AdminController::class, 'deleteChallengeResult'])->name('admin.deleteChallengeResult');

    // Basics
    Route::get('/admin/basics', [AdminController::class, 'basicsResultsIndex'])->name('admin.basicsResultsIndex');
    Route::patch('/admin/basics/{basic}/approve', [AdminController::class, 'basicsResultsApprove'])->name('admin.basicsResultsApprove');
    Route::delete('/admin/basics/{basic}', [AdminController::class, 'basicsResultsDelete'])->name('admin.basicsResultsDelete');

    // Users
    Route::get('/admin/users', [AdminController::class, 'indexUsers'])->name('admin.users.index');
    Route::get('/admin/users/create', [AdminController::class, 'createUser'])->name('admin.users.create');
    Route::post('/admin/users', [AdminController::class, 'storeUser'])->name('admin.users.store');
    Route::get('/admin/users/{user}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::put('/admin/users/{user}', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/admin/users/{user}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');

    // Posts
    Route::get('/admin/posts', [PostController::class, 'adminIndex'])->name('admin.posts.index');
    Route::get('/admin/posts/create', [PostController::class, 'create'])->name('admin.posts.create');
    Route::post('/admin/posts', [PostController::class, 'store'])->name('admin.posts.store');
    Route::get('/admin/posts/{post}/edit', [PostController::class, 'edit'])->name('admin.posts.edit');
    Route::put('/admin/posts/{post}', [PostController::class, 'update'])->name('admin.posts.update');
    Route::delete('/admin/posts/{post}', [PostController::class, 'destroy'])->name('admin.posts.destroy');
});

// Route::get('/test-email', function () {
//     Mail::raw('This is a test email!', function ($message) {
//         $message->to('support@turnikas.eu')
//             ->subject('Test Email');
//     });

//     return 'Email sent!';
// });


// Include Auth Routes
require __DIR__ . '/auth.php';
