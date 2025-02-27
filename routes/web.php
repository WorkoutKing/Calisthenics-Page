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
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\MuscleGroupController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ReleaseController;
use App\Http\Controllers\WorkoutController;
use App\Http\Controllers\SitemapController;
use Illuminate\Http\Request;



Route::get('/welcome', function () {
    return view('welcome');
})->middleware(['auth', 'verified'])->name('welcome');

// Authenticated User Routes
Route::middleware('auth')->group(function () {

    // Workout Routes
    Route::prefix('workouts')->name('workouts.')->group(function () {
        Route::get('/my', [WorkoutController::class, 'myWorkouts'])->name('my');
        Route::get('/create', [WorkoutController::class, 'create'])->name('create');
        Route::post('/', [WorkoutController::class, 'store'])->name('store');
        Route::get('/{workout}/edit', [WorkoutController::class, 'edit'])->name('edit');
        Route::put('/{workout}', [WorkoutController::class, 'update'])->name('update');
        Route::delete('/{workout}', [WorkoutController::class, 'destroy'])->name('destroy');
    });

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

    // Release Routes
    Route::get('releases/create', [ReleaseController::class, 'create'])->name('releases.create');
    Route::post('releases', [ReleaseController::class, 'store'])->name('releases.store');
    Route::get('releases/{release}', [ReleaseController::class, 'show'])->name('releases.show');
    Route::get('releases/{release}/edit', [ReleaseController::class, 'edit'])->name('releases.edit');
    Route::put('releases/{release}', [ReleaseController::class, 'update'])->name('releases.update');
    Route::delete('releases/{release}', [ReleaseController::class, 'destroy'])->name('releases.destroy');

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
    Route::get('/elements/{element_id}/edit', [ElementController::class, 'edit'])->name('elements.edit');
    Route::put('/elements/{element_id}', [ElementController::class, 'update'])->name('elements.update');


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

    // Exercises
    Route::get('/admin/exercises', [ExerciseController::class, 'index'])->name('admin.exercises.index');
    Route::get('/admin/exercises/create', [ExerciseController::class, 'create'])->name('admin.exercises.create');
    Route::get('/admin/exercises/{exercise}', [ExerciseController::class, 'show'])->name('admin.exercises.show');
    Route::post('/admin/exercises', [ExerciseController::class, 'store'])->name('admin.exercises.store');
    Route::get('/admin/exercises/{exercise}/edit', [ExerciseController::class, 'edit'])->name('admin.exercises.edit');
    Route::put('/admin/exercises/{exercise}', [ExerciseController::class, 'update'])->name('admin.exercises.update');
    Route::delete('/admin/exercises/{exercise}', [ExerciseController::class, 'destroy'])->name('admin.exercises.destroy');

    // Muscle Groups
    Route::get('/admin/muscle-groups', [MuscleGroupController::class, 'index'])->name('admin.muscle_groups.index');
    Route::get('/admin/muscle-groups/create', [MuscleGroupController::class, 'create'])->name('admin.muscle_groups.create');
    Route::post('/admin/muscle-groups', [MuscleGroupController::class, 'store'])->name('admin.muscle_groups.store');
    Route::get('/admin/muscle-groups/{muscleGroup}/edit', [MuscleGroupController::class, 'edit'])->name('admin.muscle_groups.edit');
    Route::put('/admin/muscle-groups/{muscleGroup}', [MuscleGroupController::class, 'update'])->name('admin.muscle_groups.update');
    Route::delete('/admin/muscle-groups/{muscleGroup}', [MuscleGroupController::class, 'destroy'])->name('admin.muscle_groups.destroy');
});
// Public Profile (Must to be last becouse then user cant open notifications)
Route::get('/workouts', [WorkoutController::class, 'index'])->name('workouts.index');
Route::get('/workouts/{workout:slug}', [WorkoutController::class, 'show'])->name('workouts.show');
Route::get('releases', [ReleaseController::class, 'index'])->name('releases.index');
Route::get('/', action: [HomeController::class, 'index'])->name('welcome');
Route::get('/elements', action: [ElementController::class, 'index'])->name('elements.index');
Route::get('/elements/statistics', [ElementController::class, 'statistics'])->name('elements.statistics');
Route::get('/basics/statistics', action: [BasicController::class, 'statistics'])->name('basics.statistics');
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{post:slug}', [PostController::class, 'show'])->name('posts.show');
Route::get('/challenges', [ChallengeController::class, 'index'])->name('challenges.index');
Route::get('/challenges/{id}', [ChallengeController::class, 'show'])->name('challenges.show');
Route::get('/profile/{userId}', [ProfileController::class, 'otherUserProfile'])->name('profile.other');
Route::get('/exercises', [ExerciseController::class, 'publicIndex'])->name('exercises.index');
Route::get('/exercises/{exercise:slug}', [ExerciseController::class, 'publicShow'])->name('exercises.show');
Route::get('/about-us', [PagesController::class, 'indexAboutUs'])->name('pages.about-us');
Route::get('/privacy-policy', [PagesController::class, 'indexPrivacy'])->name('pages.privacy-policy');
Route::get('/one-rep-max-calculators', [PagesController::class, 'indexCalculator'])->name('pages.calculator');

Route::get('/generate-sitemap', function (Request $request) {
    if ($request->query('key') !== 'my_secret_key') {
        abort(403, 'Unauthorized');
    }

    app(SitemapController::class)->generateSitemap();

    return response()->json(['message' => 'Sitemap generated successfully!']);
});

// Include Auth Routes
require __DIR__ . '/auth.php';
