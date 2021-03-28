<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Post;
use stdClass;

class SiteMapController extends Controller
{

    public function index(Request $request)
    {
        $datas[0] = new stdClass;
        $datas[0]->loc = route('site-map.page');
        $datas[0]->last_mod = Page::lastUpdateDate();


        $datas[1] = new stdClass;
        $datas[1]->loc = route('site-map.post');
        $datas[1]->last_mod = Post::lastUpdateDate();

        return response()->view('sitemap.index', [
            'datas' => $datas
        ])->header('Content-Type', 'text/xml');
    }

    public function showPage(Request $request)
    {
        $pages = Page::list();
        return response()->view('sitemap.show', [
            'datas' => $pages,
            'route' => 'page.show'
        ])->header('Content-Type', 'text/xml');
    }

    public function showPost(Request $request)
    {
        $post = Post::list();
        return response()->view('sitemap.show', [
            'datas' => $post,
            'route' => 'post.show'
        ])->header('Content-Type', 'text/xml');
    }
}
