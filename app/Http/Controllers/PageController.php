<?php

namespace App\Http\Controllers;

use App\Models\Page;

class PageController extends Controller
{
    public function show($slug)
    {
        $page = Page::where('slug', $slug)->firstOrFail();
        return view('frontend.pages.show', compact('page'));
    }
}