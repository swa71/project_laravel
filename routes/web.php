<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\PostController;

////////////////////////////////////////////////////////

Route::get('/postss', [PostController::class, 'welcome']);

/////////////////////////////////////////////////////


//ROUTE FOR PAGE PORTFOLIO
Route::get('/', [PortfolioController::class, 'index']);

//ROUTE FOR PAGE ADMIN
Route::resource('/admin/posts', PostController::class)->names([
    'index'   => 'posts.admin',
    'create'  => 'posts.create',
    'store'   => 'posts.store',
    'edit'    => 'posts.edit',
    'update'  => 'posts.update',
    'destroy' => 'posts.destroy',
]);

//ROUTE FOR AFFICHE THE POSTS
Route::get('/main', [PostController::class, 'showPosts'])->name('posts.main');

//ROUTE FOR VIDEOS
Route::get('/videos', [PostController::class, 'showPostsWithVideos'])->name('posts.videos');
Route::get('/post/{post}', [PostController::class, 'showPost'])->name('posts.show');
////////////////////////////////////////////////////////////////////////////////

//login for admin
use App\Http\Controllers\AuthController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// route protégée par middleware


Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/posts', [PostController::class, 'index'])->name('posts.admin');          // Liste posts admin
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create'); // Formulaire création
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');         // Enregistrement
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit'); // Formulaire édition
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');  // Mise à jour
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy'); // Suppression
});

