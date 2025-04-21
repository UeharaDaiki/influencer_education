<?php

namespace App\Http\Controllers\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Curriculum;
use App\Models\DeliveryTime;
use App\Models\Grade;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CurriculumController extends Controller
{
    public function  showCurriculumList(Request $request)
    {
        Auth::loginUsingId(1); // ユーザーID 1 でログイン
        $userId = Auth::id(); // ログインしたユーザーのIDを取得


        $grades = Grade::all();
        $curriculums = Curriculum::where('grade_id', $userId)->get();
        $delivery_times = DeliveryTime::all();

        $grade = User::find($userId)->grade;
        $gradeName = $grade->name;

        foreach ($delivery_times as $delivery_time) {
            $delivery_time->formatted_from = Carbon::createFromFormat('Y-m-d H:i:s', $delivery_time->delivery_from)->format('m月d日 H:i');
            $delivery_time->formatted_to = Carbon::createFromFormat('Y-m-d H:i:s', $delivery_time->delivery_to)->format('m月d日 H:i');
        }

        $delivery_from = $delivery_time->formatted_from;
        $delivery_to = $delivery_time->formatted_to;

        return view('user.curriculum_list', compact('grades', 'curriculums', 'delivery_from', 'delivery_to', 'gradeName'));
    }
}
