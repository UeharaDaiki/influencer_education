<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curriculums extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'title',
        'thumbnail',
        'description',
        'video_url',
        'alway_delivery_flg',
        'grade_id'
    ];

    // Gradeと紐付ける為に書く
    public function grade() {
        return $this->belongsTo(Grade::class, 'grade_id');
    }
    // Delivery_timesと紐付ける為に書く
    public function delivery_times() {
        return $this->belongsTo(Delivery_times::class, 'id');
    }
    
/**
 * 
 * alway_delivery_flgが
 * 「０」ならばdelivery_timesから
 * delivery_fromとdelivery_toを取得し渡す
 * 
 * 「１」ならばCurriculumsのみgetする
 */
    // 初期表示　1年取得
    public static function getCurriculums($grade_id) {
        return self::where('grade_id', $grade_id)->get();  
    }
}
