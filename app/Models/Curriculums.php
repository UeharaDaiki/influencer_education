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
        'always_delivery_flg',
        'grade_id'
    ];

    protected $casts = [
        'always_delivery_flg' => 'boolean',
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

    // 新規登録処理
    public static function createCurriculumRegistration($register_curriculum) {
        return self::create($register_curriculum);
    }

    // 授業編集画面表示
    public static function getEditCurriculum($id) {
        return self::where('id', $id)->get();
        //::find($id);でも同じ結果
    }

    // curriculum更新処理
    public static function updateCurriculum($update_curriculum , $id) {
        //findOrFail$idが一致するデータを取得
        $curriculum = self::findOrFail($id);
        //fill相違がある箇所を比較（頭に記載の$fillable）
        $curriculum -> fill($update_curriculum);
        return $curriculum->save();
    }
}
