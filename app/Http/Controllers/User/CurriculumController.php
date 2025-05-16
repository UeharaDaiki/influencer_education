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

        $curriculums = Curriculum::with(['deliveryTimes' => function ($query) use ($start, $end) {
            $query->where('delivery_from', '<=', $end)
                  ->where('delivery_to', '>=', $start);
        }])
        ->where('grade_id', $gradeId)
        ->get();
        
        // foreach ($curriculums as $curriculum) {
        //     if ($curriculum->deliveryTimes) {
        //         foreach ($curriculum->deliveryTimes as $delivery_time) {
        //             // 配信時間のフォーマットを整形
        //             $delivery_time->formatted_from = Carbon::parse($delivery_time->delivery_from)->format('n月j日 H:i');
        //             $delivery_time->formatted_to = Carbon::parse($delivery_time->delivery_to)->format('n月j日 H:i');
        //         }
        //     }
        // }

        return view('user.curriculum_list', compact('grades', 'curriculums', 'gradeName', 'gradeId', 'currentYear', 'currentMonth'));
    }

    //月ごとの時間割データを取得するメソッド
    public function getCurriculumByYearMonth($currentYear, $currentMonth, $gradeId)
    {
        // 月の初日と最終日を取得
        // Carbonを使用して、指定された年と月の初日と最終日を取得
        $start = Carbon::create($currentYear, $currentMonth, 1)->startOfMonth();
        $end = Carbon::create($currentYear, $currentMonth, 1)->endOfMonth();

        // 該当のカリキュラムを取得
        $curriculums = Curriculum::with(['deliveryTimes' => function ($query) use ($start, $end) {
            $query->where('delivery_from', '<=', $end)
                  ->where('delivery_to', '>=', $start);
        }])
        ->where('grade_id', $gradeId)
        ->get();

        // // 整形処理を追加
        // foreach ($curriculums as $curriculum) {
        //     if ($curriculum->deliveryTimes) {
        //         foreach ($curriculum->deliveryTimes as $delivery_time) {
        //             $delivery_time->formatted_from = Carbon::parse($delivery_time->delivery_from)->format('n月j日 H:i');
        //             $delivery_time->formatted_to = Carbon::parse($delivery_time->delivery_to)->format('n月j日 H:i');
        //         }
        //     }
        // }

        return response()->json($curriculums);
    }
}
