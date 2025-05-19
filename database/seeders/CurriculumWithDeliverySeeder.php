<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class CurriculumWithDeliverySeeder extends Seeder
{
    public function run(): void
    {
        // カリキュラム3件を作成（grade_id = 1 固定で仮置き）
        DB::table('curriculums')->insert([
            [
                'title' => '【配信中】プログラミング入門',
                'thumbnail' => 'sample.jpg',
                'description' => '配信中のカリキュラムです。',
                'video_url' => 'sample1.mp4',
                'always_delivery_flg' => 0,
                'grade_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);

        // カリキュラムIDは1として delivery_times を設定
        DB::table('delivery_times')->insert([
            [
                // 今 配信中（昨日～5日後）
                'curriculums_id' => 1,
                'delivery_from' => Carbon::now()->subDay(),
                'delivery_to' => Carbon::now()->addDays(5),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
