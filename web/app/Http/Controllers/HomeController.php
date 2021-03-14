<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        return $this->render('home', [
            'headline' => $posts = Post::getByTagName('headline', 5),
            'newPosts' => Post::getNewPosts($posts->pluck('id')->toArray()),
            'page' => Page::getForStaticPage('home')
        ]);
    }
}
