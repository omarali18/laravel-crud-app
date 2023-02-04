<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function deletePost(Post $post){
        if(auth()->user()->id === $post["user_id"]){
            $post->delete();
        };
        return redirect('/');
        // print_r("kkkkkkkkkkkkkkk");
    }

    public function updatePost(Post $post, Request $request){
        if(auth()->user()->id !== $post['user_id']){
            return redirect('/');
        };
        $updateField = $request->validate([
            'title' => "required",
            'body' => "required"
        ]);
        $updateField['title'] = strip_tags($updateField["title"]);
        $updateField["body"] = strip_tags($updateField["body"]);

        $post->update($updateField);
        return redirect('/');
    }

    public function showEditPost(Post $post){
        // dd($post);
        if(auth()->user()->id !== $post["user_id"]){
            return redirect("/");
        }
        return view("edit-post", ['post' => $post]);
    }

    public function createPosts(Request $request)
    {
        $postsField = $request->validate([
            "title" => "required",
            'body' => 'required'
        ]);
        $postsField["title"] = strip_tags($postsField["title"]);
        $postsField["body"] = strip_tags($postsField["body"]);
        $postsField["user_id"] = auth()->id();
        Post::create($postsField);
        // return "post doneeeeeeeeeeeee";
        return redirect("/");
    }
}
