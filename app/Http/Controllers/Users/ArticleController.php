<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    public function show($id)
    {
        // 実装は他の人が行うため未記述
        return view('Users.auth.article');
    }
}
