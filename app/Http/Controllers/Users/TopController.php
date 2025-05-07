<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Banner;

class TopController extends Controller
{
    public function top()
    {
        $banner = Banner::latest()->first(); // 最も新しいバナー画像1件
        $article_top = Article::orderBy('posted_date', 'desc')->take(5)->get();

        return view('Users.auth.top', compact('banner', 'article_top'));
    }
}
