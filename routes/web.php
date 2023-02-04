<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\models\User;
use Monolog\Handler\RotatingFileHandler;

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

// photo and file apload
Route::post("/photo", function(){
    return view("image");
});
