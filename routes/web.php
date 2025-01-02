<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\SubscribeController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\frontController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\NatureController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\StageNameController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Models\Newsletter;
use Illuminate\Support\Facades\Auth;
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

Route::get('/',[frontController::class,'index'])->name('index');
Route::get('/login', [UserController::class, 'index'])->name('login');
Route::post('/check', [UserController::class, 'check'])->name('login-check');

Route::get('/about',[frontController::class,'about'])->name('about');
Route::get('/contact',[frontController::class,'contact'])->name('contact');
Route::get('/blogs',[frontController::class,'blist'])->name('blog.list');
Route::get('/blog-detail/{title}',[frontController::class,'bdetail'])->name('single.single');

//search blog
Route::get('/blog/search',[frontController::class,'searchBlog'])->name('blog.search');

//comment submit
Route::post('/blog/comment',[frontController::class,'commentSubmit'])->name('comment.submit');
Route::post('/comment/comment',[frontController::class,'commentComment'])->name('comment.comment');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [UserController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/logout', function () {
        Auth::logout(); // Log out the user
        request()->session()->invalidate(); // Invalidate the session
        request()->session()->regenerateToken(); // Regenerate CSRF token to prevent attacks

        return redirect('/login')->with('success', 'Logout Successfully'); // Redirect to login page or any page you want after logout
    })->name('logout');

    //category routes
    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/category-add', [CategoryController::class, 'show'])->name('category.add');
    Route::post('/category-create', [CategoryController::class, 'create'])->name('category.create');
    Route::get('/category-edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('/category-update/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::get('/category-delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');

    //tag routes
    Route::get('/tag', [TagController::class, 'index'])->name('tag.index');
    Route::get('/tag-add', [TagController::class, 'show'])->name('tag.add');
    Route::post('/tag-create', [TagController::class, 'create'])->name('tag.create');
    Route::get('/tag-edit/{id}', [TagController::class, 'edit'])->name('tag.edit');
    Route::post('/tag-update/{id}', [TagController::class, 'update'])->name('tag.update');
    Route::get('/tag-delete/{id}', [TagController::class, 'delete'])->name('tag.delete');

    //nature routes
    Route::get('/nature', [NatureController::class, 'index'])->name('nature.index');
    Route::get('/nature-add', [NatureController::class, 'show'])->name('nature.add');
    Route::post('/nature-create', [NatureController::class, 'create'])->name('nature.create');
    Route::get('/nature-edit/{id}', [NatureController::class, 'edit'])->name('nature.edit');
    Route::post('/nature-update/{id}', [NatureController::class, 'update'])->name('nature.update');
    Route::get('/nature-delete/{id}', [NatureController::class, 'delete'])->name('nature.delete');

    //blog routes
    Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
    Route::get('/blog-add', [BlogController::class, 'show'])->name('blog.add');
    Route::post('/blog-create', [BlogController::class, 'create'])->name('blog.create');
    Route::get('/blog-edit/{id}', [BlogController::class, 'edit'])->name('blog.edit');
    Route::post('/blog-update/{id}', [BlogController::class, 'update'])->name('blog.update');
    Route::get('/blog-delete/{id}', [BlogController::class, 'delete'])->name('blog.delete');
    Route::post('/blog-check', [BlogController::class, 'check'])->name('blog.check');
    Route::get('/blog-changestatus', [BlogController::class, 'update_status'])->name('blog.status');

    //authors routes
    Route::get('/author', [AuthorController::class, 'index'])->name('author.index');
    Route::get('/author-add', [AuthorController::class, 'show'])->name('author.add');
    Route::post('/author-create', [AuthorController::class, 'create'])->name('author.create');
    Route::get('/author-edit/{id}', [AuthorController::class, 'edit'])->name('author.edit');
    Route::post('/author-update/{id}', [AuthorController::class, 'update'])->name('author.update');
    Route::post('/author-delete/{id}', [AuthorController::class, 'delete'])->name('author.delete');

    //extra view routes
    Route::get('/stagename', [StageNameController::class, 'index'])->name('stagename.index');
    Route::get('/stagename-add', [StageNameController::class, 'show'])->name('stagename.add');
    Route::post('/stagename-create', [StageNameController::class, 'create'])->name('stagename.create');
    Route::get('/stagename-edit/{id}', [StageNameController::class, 'edit'])->name('stagename.edit');
    Route::post('/stagename-update/{id}', [StageNameController::class, 'update'])->name('stagename.update');
    Route::get('/stagename-delete/{id}', [StageNameController::class, 'delete'])->name('stagename.delete');

    Route::get('/newsletter', [NewsletterController::class, 'index'])->name('newsletter.index');
    Route::get('/newsletter-delete/{id}', [NewsletterController::class, 'delete'])->name('newsletter.delete');

    Route::get('/subscribe', [SubscribeController::class, 'index'])->name('subscribe.index');
    Route::get('/subscribe-delete/{id}', [SubscribeController::class, 'delete'])->name('subscribe.delete');
});
