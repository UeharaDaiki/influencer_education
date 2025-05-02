<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CurriculumController extends Controller
{
    public function showCurriculumList()
    {
        return view('Users.auth.curriculum_list');
    }
}
