<?php

namespace App\Http\Controllers;

use Helpers\PostHelper;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function show(Request $request)
    {
        $page = Page::findBySlug($request->slug);
        $page->content = PostHelper::optimize($page->content);

        if (!$page) {
            abort(404);
        }

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

        return $this->render('blog.show', [
            'page' => $page
        ]);
    }
}
