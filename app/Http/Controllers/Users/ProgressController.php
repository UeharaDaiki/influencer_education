<?php

namespace App\Http\Controllers\Users;

use App\Consts\GradeTitles;
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
        $curriculumsProgress = CurriculumProgress::where('users_id', $userId)->where('clear_flg',true)->get();
        
        // 画面表示用に学年の文字列を用意
        $gradeTitles = GradeTitles::GRADE;
        
        return view('user.curriculum_progress', compact('curriculums','curriculumsProgress','user','gradeTitles'));
    }
}
