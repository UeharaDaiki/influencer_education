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
    // Gradeと紐付ける為に書く
    public function delivery_times() {
        return $this->belongsTo(Delivery_times::class, 'id');
    }
    

    //初期表示　全件取得
    // public static function getCurriculums() {
    //     return Curriculums::all();        
    // }

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

    // alway_delivery_flgが０の時delivery_fromとdelivery_toを取得
    // public static function getCurriculums($grade_id){
    //     $curriculums = self::where('grade_id', $grade_id)->get();
    //     // 受け取り用
    //     $data = [];
    //     //全件回る
    //     foreach($curriculums as $curriculum) {
    //         if($curriculums->alway_delivery_flg === 0; ){
    //             $data = Delivery_times::where('curriculums_id',$curriculum->id)->get();
    //         }
    //         return $curriculums;
    //     }
        
    //     return   
    // }
}
