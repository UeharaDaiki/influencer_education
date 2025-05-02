<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProgressController extends Controller
{
    public function showProgress()
    {
        return view('Users.auth.curriculum_progress');
    }
}
