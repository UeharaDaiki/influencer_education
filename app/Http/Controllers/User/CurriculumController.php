<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;

use App\Models\Curriculum;
use App\Models\DeliveryTime;
use App\Models\Grade;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CurriculumController extends Controller
{
    public function  showCurriculumList(Request $request)
    {

        $grades = Grade::all();
        $curriculums = Curriculum::all();
        $delivery_times = DeliveryTime::all();

        foreach ($delivery_times as $delivery_time) {
            $delivery_time->formatted_from = Carbon::createFromFormat('Y-m-d H:i:s', $delivery_time->delivery_from)->format('m月d日 H:i');
            $delivery_time->formatted_to = Carbon::createFromFormat('Y-m-d H:i:s', $delivery_time->delivery_to)->format('m月d日 H:i');
        }

        return view('user.curriculum_list', compact('grades', 'curriculums', 'delivery_times'));
    }
}
