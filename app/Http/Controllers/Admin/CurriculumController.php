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
     */
    public function showCurriculumList () {
        $grades = Grade::getGrade();
        $curriculums = Curriculums::getCurriculums($grades[0]->id);
        $curriculums_id = $curriculums->pluck('id');
        // dd($curriculums_id);
        $delivery_times = DeliveryTime::getDelivery_times($curriculums_id);
        // 条件付きで取得alwaysTB
        dd($delivery_times);
        return view('user.curriculum_list',compact('grades' , 'curriculums' , 'delivery_times'));
    }


}
