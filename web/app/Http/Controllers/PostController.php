<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Helpers\AmpHelper;
use Helpers\BreadcrumbHelper;
use Helpers\PostHelper;
use Helpers\StructureDataHelper;

class PostController extends Controller
{
    public function show(Request $request)
    {
        $post = Post::findBySlug($request->slug);
        $post->content = PostHelper::optimize($post->content);

        if (!$post) {
            abort(404);
        }

        $post->meta->created_at = null;
        $post->meta->updated_at = null;
        $post->meta->image = ($post->image ? url($post->image) : asset('images/logo.png'));
        $post->meta->url = str_replace('www.', '', url()->full());
        $this->meta = $post->meta;

        $this->breadcrumb = BreadcrumbHelper::make();
        $this->structureData = StructureDataHelper::make(
            [
                'url' => $this->meta->url,
                'title' => $this->meta->title,
                'description' => $this->meta->description,
                'image' => $this->meta->image,
                'created_at' => $this->meta->created_at,
                'updated_at' => $this->meta->updated_at
            ]
        );

        return $this->render('blog.show', [
            'post' => $post
        ]);
    }

    public function showAmp(Request $request)
    {
        $post = Post::findBySlug($request->slug);

        if (!$post) {
            abort(404);
        }

        $post->meta->created_at = null;
        $post->meta->updated_at = null;
        $post->meta->image = ($post->image ? url($post->image) : asset('images/logo.png'));
        $post->meta->url = str_replace('www.', '', url()->full());
        $post->meta->url = str_replace('amp/', '', $post->meta->url);
        $this->meta = $post->meta;

        $this->breadcrumb = BreadcrumbHelper::make();
        $this->structureData = StructureDataHelper::make(
            [
                'url' => $this->meta->url,
                'title' => $this->meta->title,
                'description' => $this->meta->description,
                'image' => $this->meta->image,
                'created_at' => $this->meta->created_at,
                'updated_at' => $this->meta->updated_at
            ]
        );

        $this->breadcrumb;

        $this->amp = true;

        $amp = $this->render('blog.amp.show', [
            'post' => $post
        ], true);

        return $amp = AmpHelper::optimize($amp);
    }
}
