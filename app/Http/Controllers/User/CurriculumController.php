<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;

use App\Models\Curriculum;
use App\Models\DeliveryTime;
use App\Models\Grade;
use Illuminate\Http\Request;

class CurriculumController extends Controller
{
    public function  showCurriculumList(Request $request)
    {

        $grades = Grade::all();
        return view('user.curriculum_list', compact('grades'));
    }
}
