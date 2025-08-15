<?php

use App\Http\Controllers\ClapController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicProfileController;
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

// tell laravel to do the matching based on the slug, not the default depencies injection
Route::get('/@{username}/{post:slug}', [PostController::class, 'show'])
    ->name('post.show');

Route::get('/', [PostController::class, 'index'])
        ->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function() {

    Route::get('/post/create', [PostController::class, 'create'])
    ->name('post.create');

    Route::post('/post/store', [PostController::class, 'store'])
    ->name('post.store');

    Route::get('/my-posts', [PostController::class, 'myPosts'])
        ->name('my_posts');

    Route::get('/category/{category:name}', [PostController::class, 'category'])
        ->name('post_by_category');

    Route::post('/follow/{user:id}', [FollowerController::class, 'followOrUnfollow'])
        ->name('follow_or_unfollow');

    Route::post('/clap/{post:id}', [ClapController::class, 'capOrUnclap'])
        ->name('clap_or_unclap');
});

Route::get('/@{user:username}/', [PublicProfileController::class, 'show'])
    ->name('profile.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
