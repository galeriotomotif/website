<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use App\Models\Post;
use Helpers\BreadcrumbHelper;
use Helpers\StructureDataHelper;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $page = Page::getForStaticPage('home');

        $page->meta->image = ($page->image ? url($page->image) : asset('images/logo.png'));
        $page->meta->url = str_replace('www.', '', url()->full());
        $this->meta = $page->meta;

        $this->breadcrumb = BreadcrumbHelper::make();
        $this->structureData = StructureDataHelper::make(
            [
                'url' => $this->meta->url,
                'title' => $this->meta->title,
                'description' => $this->meta->description,
                'image' => $this->meta->image,
                'created_at' => $page->published_at->format('Y-m-d'),
                'updated_at' => $page->updated_at->format('Y-m-d')
            ]
        );

        $this->amp_available = false;

        return $this->render('home', [
            'headline' => $posts = Post::getByTagName('headline', 5),
            'newPosts' => Post::getNewPosts($posts->pluck('id')->toArray()),
        ]);
    }
}
