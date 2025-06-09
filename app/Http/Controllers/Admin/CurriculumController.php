<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ItemRequest;
use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\Curriculums;
use App\Models\DeliveryTime;
use App\Http\Requests\CurriculumsRequest;
use Illuminate\Database\QueryException;
use Carbon\Carbon;


class CurriculumController extends Controller
{
    //授業一覧・設定用
    /**
     * 授業一覧
     * 表示
     */
    public function showCurriculumList ($id = null) {
        $grades = Grade::getGrade();
        if($id === null) {
            // 初期表示　1年生
            $curriculums = Curriculums::getCurriculums($grades[0] -> id);
            $grade_name = Grade::getGradeName($grades[0] -> id);
        } else {
            // 学年ボタン押下
            $grade_name = Grade::getGradeName($id);
            $curriculums = Curriculums::getCurriculums($id);
        }
        // 学年のidのみ取得
        $curriculums_id = $curriculums -> pluck('id');
        // 公開期間
        $delivery_times = DeliveryTime::getDeliveryTimes($curriculums_id);
        return view('admin.layouts.curriculum_list',compact('grades' , 'curriculums' , 'delivery_times' , 'grade_name'));
    }

    /**
     * 新規登録
     * 画面表示
     */
    public function showCurriculumRegistration() {
        //学年プルダウン用
        $grades = Grade::getGrade();
        return view('admin.layouts.curriculum_registration',compact('grades'));
    }

    /**
     * 新規登録
     * 登録処理
     */
    public function curriculumRegistration(CurriculumsRequest $request) {
        if ($request -> hasFile('curriculum_img')) {
            $path = $request -> file('curriculum_img') -> store('images', 'public');
            //登録する画像pathを'storage/'に揃える
            $img_path = 'storage/' . $path;
        }
        $register_curriculum = $request -> validated();
        if(isset($img_path)){
            $register_curriculum = array_merge($register_curriculum, ['thumbnail' => $img_path]);   
        }
        try{
            //該当curriculums編集用データ
            $registering_curriculum = Curriculums::createCurriculumRegistration($register_curriculum);
            // filled(nullまたは空文字ではない時)
            if($request->filled('delivery-from') && $request->filled('delivery-to')){
                // DateTimeの値をCarbonインスタンスに変換
                $from= Carbon::createFromFormat('Y-m-d\TH:i', $request['delivery-from']);
                $to= Carbon::createFromFormat('Y-m-d\TH:i', $request['delivery-to']);
                $delivery_times = DeliveryTime::createDeliveryTimes($registering_curriculum->id , $from , $to);
            }
            return redirect() -> route('admin.show.curriculum.list');
        } catch (QueryException $e) {
            return redirect() -> route('admin.show.curriculum.registration') -> with(['error' => 'データベースエラー'], 500);
        } catch (\Exception $e) {
            return redirect() -> route('admin.show.curriculum.registration') -> with(['error' => '処理に失敗しました'], 500);
        }
    }

    /**
     * 授業編集
     * 表示
     */
    public function showCurriculumEdit($id) {
        //学年プルダウン用
        $grades = Grade::getGrade();
        //該当curriculums編集用データ
        $edit_curriculum = Curriculums::getEditCurriculum($id);
        $id = $id;
        // 公開期間
        return view('admin.layouts.curriculum_edit',compact('grades','edit_curriculum','id'));
    }
    
    /**
     * 授業編集
     * 更新処理
     */
    public function updateCurriculum(CurriculumsRequest $request , $id) {
        if ($request -> hasFile('curriculum_img')) {
            $path = $request -> file('curriculum_img') -> store('images', 'public');
            //更新した後の画像pathを'storage/'に揃える
            $img_path = 'storage/' . $path;
        }
        // バリデしたものを取得する（必要なものはバリデクラスにかく）
        $update_curriculum = $request -> validated();
        if(isset($img_path)){
            $update_curriculum = array_merge($update_curriculum, ['thumbnail' => $img_path]);   
        }
        try {
            Curriculums::updateCurriculum($update_curriculum , $id);
            return redirect() -> route('admin.show.curriculum.list');
        } catch (QueryException $e) {
            return redirect() -> route('admin.show.curriculum.edit', [$id]) -> with(['error' => 'データベースエラー'], 500);
        } catch (\Exception $e) {
            return redirect() -> route('admin.show.curriculum.edit', [$id]) -> with(['error' => '処理に失敗しました'], 500);
        }
    }
}
