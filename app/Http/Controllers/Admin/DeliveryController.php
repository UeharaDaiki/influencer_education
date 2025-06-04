<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Curriculums;
use App\Models\DeliveryTime;
use Illuminate\Http\Request;
use App\Http\Requests\DeliveryTimesRequest;
use Illuminate\Database\QueryException;

class DeliveryController extends Controller
{
    public function showDeliveryEdit($id) {
        $title = Curriculums::getCurriculumsTitle($id);
        $deliveryTime = DeliveryTime::getDeliveryTime($id);
        $id;
        return view('admin.layouts.delivery', compact('title','id','deliveryTime'));
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
        try{
            DeliveryTime::updateTimes($id , $times);
            return redirect() -> route('admin.show.curriculum.list');
        }catch (QueryException $e) {
            return redirect() -> route('admin.show.delivery.edit', [$id]) -> with(['error' => 'データベースエラー'], 500);
        } catch (\Exception $e) {
            return redirect() -> route('admin.show.delivery.edit', [$id]) -> with(['error' => '処理に失敗しました'], 500);
        }
    }
}
