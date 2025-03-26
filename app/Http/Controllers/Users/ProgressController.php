<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Curriculum;
use App\Models\CurriculumProgress;
use App\Models\Curriculums;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgressController extends Controller
{
    public function showProgress()
    {
        $curriculums = Curriculums::all();

        $userId = 1; //仮でユーザーIDは1に設定する。
        //$userId = Auth::id(); //ログインユーザーIDを取得。
        $user = User::find($userId);
        
        // 進捗テーブルからユーザーIDが一致している、かつ、クリアフラグが1のデータを取得
        $curriculumsProgress = CurriculumProgress::where('users_id', $userId)->where('clear_flg',1)->get();
        
        // 画面表示用に学年の文字列を用意
        $gradeTitles = [
            1 => '小学1年生',
            2 => '小学2年生',
            3 => '小学3年生',
            4 => '小学4年生',
            5 => '小学5年生',
            6 => '小学6年生',
            7 => '中学1年生',
            8 => '中学2年生',
            9 => '中学3年生',
            10 => '高校1年生',
            11 => '高校2年生',
            12 => '高校3年生',
        ];
        
        return view('user.curriculum_progress', compact('curriculums','curriculumsProgress','user','gradeTitles'));
    }
}
