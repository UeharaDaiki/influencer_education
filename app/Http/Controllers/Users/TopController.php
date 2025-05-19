<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Banner;

class TopController extends Controller
{
    public function top()
    {
        $banners = Banner::orderBy('id', 'desc')->take(4)->get();
        $article_top = Article::orderBy('posted_date', 'desc')->take(5)->get();

        return view('Users.auth.top', compact('banners', 'article_top'));
    }
}
