<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryTime extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'curriculums_id',
        'delivery_from',
        'delivery_to'
    ];

/**
 * 
 * 配列を渡すときは
 * whereInを使う
 * 
 */

    // 取得
    public static function getDelivery_times($id) {
        return self::whereIn('curriculums_id', $id)->get();
    }

    // 取得
    public static function getDelivery_time($id) {
        return self::where('curriculums_id', $id)->get();
    }


    // 新規登録
    public static function createDeliveryTimes($id , $from , $to) {
        return self::create([
            'curriculums_id' => $id, 
            'delivery_from' => $from,
            'delivery_to' => $to
        ]);
    }

    // 配信日時更新処理
    public static function updateTimes($id , $times) {
        // 削除して登録
        self::where('curriculums_id' , $id)->delete();
        // 存在するだけ登録する
        foreach($times as $time) {
            self::create([
                'curriculums_id' => $id,
                'delivery_from' => $time['delivery_from'],
                'delivery_to' => $time['delivery_to'],
            ]);
        }
        return true;
    }
}
// // $idで一致するものを探す　なければ404エラー
        // $match_id = self::find($id);
        // // 比較　Eloquentモデル->fill(配列);
        // $update_times -> fill($times);
        // // 相違があれば$update_timesを$timesに更新
        // return $update_times -> save();