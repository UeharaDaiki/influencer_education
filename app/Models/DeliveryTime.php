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
}
