<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\Curriculums;
use App\Models\DeliveryTime;

class CurriculumController extends Controller
{
    //授業一覧・設定用

    /**
     * 授業一覧
     * 表示
     */
    public function showCurriculumList ($id = null) {
        $grades = Grade::getGrade();
        if($id === null){
            // 初期表示
            $curriculums = Curriculums::getCurriculums($grades[0] -> id);
        } else {
            // 学年ボタン押下
            $grade_name = Grade::getGradeName($id);
            $curriculums = Curriculums::getCurriculums($id);
        }
        // 学年のidのみ取得
        $curriculums_id = $curriculums -> pluck('id');
        // 公開期間
        $delivery_times = DeliveryTime::getDelivery_times($curriculums_id);
        return view('user.curriculum_list',compact('grades' , 'curriculums' , 'delivery_times' , 'grade_name'));
    }

    // /**
    //  * 授業一覧
    //  * 各学年ボタン押下時処理
    //  */
    // public function showCurriculumList () {
    //     $grades = Grade::getGrade();
    //     $curriculums = Curriculums::getCurriculums($grades[0]->id);
    //     $curriculums_id = $curriculums->pluck('id');
    //     // dd($curriculums_id);
    //     $delivery_times = DeliveryTime::getDelivery_times($curriculums_id);
    //     // 条件付きで取得alwaysTB
    //     // dd($delivery_times);
    //     return view('user.curriculum_list',compact('grades' , 'curriculums' , 'delivery_times'));
    // }

}
