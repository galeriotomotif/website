<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function show(Request $request)
    {
        $post = Post::findBySlug($request->slug);

        if (!$post) {
            abort(404);
        }


        return view('news.show')->with('post',$post);

    }
}
