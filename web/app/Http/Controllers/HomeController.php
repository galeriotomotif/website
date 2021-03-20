<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $page = Page::getForStaticPage('home');

        $this->meta = $page->meta;
        $this->meta->image =  ($page->image ? url($page->image) : asset('images/logo.png'));

        return $this->render('home', [
            'headline' => $posts = Post::getByTagName('headline', 5),
            'newPosts' => Post::getNewPosts($posts->pluck('id')->toArray()),
        ]);
    }
}
