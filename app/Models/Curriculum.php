<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Curriculum extends Model
{
    use HasFactory;

    protected $table = 'curriculums';

    public function deliveryTimes()
    {
        return $this->hasMany(DeliveryTime::class, 'curriculums_id');
    }

    public function progress()
    {
        return $this->hasMany(CurriculumProgress::class, 'curriculums_id')
            ->where('users_id', auth()->id());
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }

    // ▼ 追加部分：現在の配信状況を判定
    public function isDelivered(): bool
    {
        if ($this->always_delivery_flg) {
            return true;
        }

        if ($this->deliveryTimes->isEmpty()) {
            return false;
        }

        $now = Carbon::now();

        return $this->deliveryTimes->contains(function ($delivery) use ($now) {
            return $delivery->delivery_from <= $now && $delivery->delivery_to >= $now;
        });
    }
}
