<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DeliveryTime;

class Curriculum extends Model
{
    use HasFactory;

    protected $table = 'curriculums';

    protected $fillable = [
        'title',
        'thumbnail',
        'description',
        'video_url',
        'always_delivery_flg',
        'grade_id',
        'created_at',
        'updated_at',
    ];

    public function deliveryTimes()
    {
        return $this->hasMany(DeliveryTime::class, 'curriculums_id');
    }

    public static function getWithDeliveryTimesWithGrade($gradeId, $start, $end)
    {
        return self::with(['deliveryTimes' => function ($query) use ($start, $end) {
            $query->where('delivery_from', '<=', $end)
                  ->where('delivery_to', '>=', $start);
        }])
        ->where('grade_id', $gradeId)
        ->get();
    }
}


