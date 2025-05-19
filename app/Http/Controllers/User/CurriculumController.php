<?php

namespace App\Http\Controllers\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Curriculum;
use App\Models\Grade;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CurriculumController extends Controller
{
    public function  showCurriculumList(Request $request)
    {
        if (app()->environment('local')) {
            Auth::loginUsingId(1);
        }
        $userId = Auth::id(); // ログインしたユーザーのIDを取得

        $grades = Grade::all();
        $grade = User::with('grade')->find($userId);
        $gradeName = $grade->grade->name;
        $gradeId = $grade->grade->id;

        // 現在の月を取得
        $currentYear = $request->input('year', Carbon::now()->year); //デフォルトは現在の年
        $currentMonth = $request->input('month', Carbon::now()->month); //デフォルトは現在の月

        $start = Carbon::create($currentYear, $currentMonth, 1)->startOfMonth();
        $end = Carbon::create($currentYear, $currentMonth, 1)->endOfMonth();

        $curriculums = Curriculum::getWithDeliveryTimesWithGrade($gradeId, $start, $end);

        return view('user.curriculum_list', compact('grades', 'curriculums', 'gradeName', 'gradeId', 'currentYear', 'currentMonth'));
    }

    //月ごとの時間割データを取得するメソッド
    public function getCurriculumByYearMonth($currentYear, $currentMonth, $gradeId)
    {
        // 月の初日と最終日を取得
        // Carbonを使用して、指定された年と月の初日と最終日を取得
        $start = Carbon::create($currentYear, $currentMonth, 1)->startOfMonth();
        $end = Carbon::create($currentYear, $currentMonth, 1)->endOfMonth();

        $curriculums = Curriculum::getWithDeliveryTimesWithGrade($gradeId, $start, $end);

        return response()->json($curriculums);
    }
}
