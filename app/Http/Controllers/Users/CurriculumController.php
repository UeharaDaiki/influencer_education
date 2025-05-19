<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Curriculum;
use Illuminate\Http\Request;
use App\Models\CurriculumProgress;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CurriculumController extends Controller
{


    public function showCurriculumList()
    {
        // 授業一覧画面用（gradeのみ読み込み）
        $curriculums = Curriculum::with('grade')->get();
        return view('Users.auth.curriculum_list', compact('curriculums'));
    }

    public function complete(Request $request, $id)
    {
        $user = Auth::user();

        if (!$user) {
            Log::warning('未認証ユーザーによる受講リクエスト');
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        try {
            CurriculumProgress::updateOrCreate(
                ['users_id' => $user->id, 'curriculums_id' => $id],
                ['clear_flg' => 1]
            );
            Log::info("受講記録成功：user_id={$user->id}, curriculum_id={$id}");
            return response()->json(['message' => '受講完了']);
        } catch (\Exception $e) {
            Log::error('受講登録エラー: ' . $e->getMessage());
            return response()->json(['error' => 'DBエラー'], 500);
        }
    }
}
