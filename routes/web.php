<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $posts = [];
    if (auth()->check()) {
        $posts = auth()->user()->usersCoolPosts()->latest()->get();
    }

    // $posts = auth()->user()->usersCoolPosts()->latest()->get();
    // $posts = Post::all();
    // $posts = Post::where("user_id", auth()->id())->get();
    return view('home', ["posts" => $posts]);
});
Route::post("/register", [UserController::class, "registation"]);
Route::post("/logout", [UserController::class, "logout"]);
Route::post("/login", [UserController::class, "login"]);

// POST ROUTE
Route::post("/create-post", [PostController::class, 'createPosts']);
Route::get("/edit-post/{post}",[PostController::class, "showEditPost"]);
Route::put("/edit/post/{post}", [PostController::class, "updatePost"]);
Route::delete("/delete-post/{post}",[PostController::class, "deletePost"]);
// 
// Route::post("/create-post", [User])
