<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProgressController extends Controller
{
    public function showProgress()
    {
        // ロジックやデータを取得し、ビューに渡す
        return view('user.curriculum_progress');
    }
}
