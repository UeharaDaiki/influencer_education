<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\Curriculums;

class CurriculumController extends Controller
{
    //授業一覧・設定用

    /**
     * 授業一覧
     */
    public function showCurriculumList () {
        $grades = Grade::getGrade();
        $curriculums = Curriculums::getCurriculums();
        return view('user.curriculum_list',compact('grades' , 'curriculums'));
    }


}
