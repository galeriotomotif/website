<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function show(Request $request)
    {
        $page = Post::findBySlug($request->slug);

        $this->meta = $page->meta;
        $this->meta->image = ($page->image ? url($page->image) : asset('images/logo.png'));

        if (!$page) {
            abort(404);
        }

        return $this->render('page.show', [
            'page' => $page
        ]);
    }
}
