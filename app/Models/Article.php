<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    // posted_dateカラムは日付として扱うことをLaravelに伝えている
    protected $casts = [
        'posted_date' => 'datetime'
    ];

    protected $fillable = ['title', 'posted_dat', 'article_contents'];
}
