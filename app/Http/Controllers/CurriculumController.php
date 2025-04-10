<?php

namespace App\Http\Controllers;

use App\Models\Curriculum;
use App\Models\DeliveryTime;
use App\Models\Grade;
use Illuminate\Http\Request;

class CurriculumController extends Controller
{
    public function  showCurriculumList()
    {
        return view('curriculum_list');
    }
}
