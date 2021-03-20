<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function show(Request $request)
    {
        $post = Post::findBySlug($request->slug);

        $this->meta = $post->meta;
        $this->meta->image = ($post->image ? url($post->image) : asset('images/logo.png'));

        if (!$post) {
            abort(404);
        }

        return $this->render('blog.show', [
            'post' => $post
        ]);
    }
}
