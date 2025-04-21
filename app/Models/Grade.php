<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name'
    ];

    // 紐付け

    // 取得
    public static function getGrade() {
        return Grade::all();
    }

    // name取得　表示中学年
    public static function getGradeName($id) {
        return self::where('id', $id)->value('name');
    }
}
