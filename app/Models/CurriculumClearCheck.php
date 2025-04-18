<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurriculumClearCheck extends Model
{
    use HasFactory;
    protected $fillable = [
        'users_id',
        'grade_id',
        'clear_flg',
        'created_at',
        'updated_at',
    ];
}
