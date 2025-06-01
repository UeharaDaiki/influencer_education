<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Curriculums;
use App\Models\DeliveryTime;
use Illuminate\Http\Request;
use App\Http\Requests\DeliveryTimesRequest;

class DeliveryController extends Controller
{
    //
    public function showDeliveryEdit($id) {
        $title = Curriculums::getCurriculumsTitle($id);
        $deliveryTime = DeliveryTime::getDelivery_time($id);
        // dd($title);
        // dd($deliveryTime);
        $id = $id;
        return view('user.delivery', compact('title','id','deliveryTime'));
    }

    // 配信日時更新処理
    public function updateDelivery(DeliveryTimesRequest $request , $id) {
        // viewから配列で渡るため配列で扱う
        $from = (array)$request->input('delivery_from');
        $to = (array)$request->input('delivery_to');
        $times = [];
        // $index 配列のカウント
        foreach($from as $index => $fromTime) {
            $times[] = [
                'delivery_from' => $fromTime,
                'delivery_to' => $to[$index],
            ];
        }
        // dd($times);
        try{
            DeliveryTime::updateTimes($id,$times);
            return redirect() -> route('admin.show.curriculum.list');
        }catch (QueryException $e) {
            // dd($e);
            return redirect() -> route('admin.show.delivery.edit', [$id]) -> with(['error' => 'データベースエラー'], 500);
        } catch (\Exception $e) {
            // dd($e);
            return redirect() -> route('admin.show.delivery.edit', [$id]) -> with(['error' => '処理に失敗しました'], 500);
        }
        
    }

    public function deleteDelivery($id) {
        dd($id);
    }
}
