<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Carbon\Carbon;

class ArticleController extends Controller
{
    public function showArticle($id)
   {
        $article = Article::find($id);
        $PostedDate = new Carbon($article->posted_date);
        $PostedDate = $PostedDate->format('Y年m月d日');
        
        return view('user.article',compact('article','PostedDate'));
    }
}
