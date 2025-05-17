<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DeliveryTime;
use App\Models\Curriculum;
use Illuminate\Support\Facades\DB;

class DeliveryTimesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // delivery_times テーブルだけ初期化（curriculumsは触らない）
        DB::table('delivery_times')->truncate();

        // 既存のカリキュラムを取得（IDは1〜50の想定）
        $curriculums = Curriculum::all();

        foreach (range(1, 100) as $i) {
            DeliveryTime::factory()->create([
                'curriculums_id' => $curriculums->random()->id,
            ]);
        }       
    }
}
