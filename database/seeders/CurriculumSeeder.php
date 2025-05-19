<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurriculumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('curriculums')->insert([
            [
                'title' => '授業タイトル',
                'thumbnail' => 'sample.jpg',
                'description' => '講座内容',
                'video_url' => 'sample.mp4',
                'always_delivery_flg' => 0,
                'grade_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        // カリキュラムIDは1として delivery_times を設定
        DB::table('delivery_times')->insert([
            [
                // 今 配信中（昨日～5日後）
                'curriculums_id' => 1,
                'delivery_from' => Carbon::now()->subDay(10),
                'delivery_to' => Carbon::now()->addDays(5),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
