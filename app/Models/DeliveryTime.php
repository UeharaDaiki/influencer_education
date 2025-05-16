<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Curriculum;
use Carbon\Carbon;

class DeliveryTime extends Model
{
    use HasFactory;

    protected $fillable = [
        'curriculums_id',
        'delivery_from',
        'delivery_to',
        'created_at',
        'updated_at',
    ];

    // JSONレスポンスに含めるカスタム属性を指定
    protected $appends = ['formatted_from', 'formatted_to'];

    public function curriculums()
    {
        return $this->belongsTo(Curriculum::class, 'curriculums_id');
    }

    // formatted_fromアクセサ（n月j日 H:iのフォーマット）
    public function getFormattedFromAttribute()
    {
        return Carbon::parse($this->delivery_from)->format('n月j日 H:i');
    }

    // formatted_toアクセサ（n月j日 H:iのフォーマット）
    public function getFormattedToAttribute()
    {
        return Carbon::parse($this->delivery_to)->format('n月j日 H:i');
    }

}

