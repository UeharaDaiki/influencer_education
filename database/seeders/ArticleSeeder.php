<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;

class ArticleSeeder extends Seeder
{
    // 
    public function run(): void
    {
        // レコードを1件1件追加するメソッド
        Article::create([
            'title' => 'ダミー記事',
            'article_contents' => 'これはダミーのお知らせです。',
            'posted_date' => now(),
        ]);
    }
}
