<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Curriculums;

class CurriculumsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //grade_idをランダムに生成
        $gradeId = [];
        // 1〜12の各grade_idを6件ずつ追加（合計72件）
        foreach (range(1, 12) as $id) {
            for ($i = 0; $i < 6; $i++) {
                $gradeIds[] = $id;
            }
        }

        shuffle($gradeIds); // 順番をランダムに

        foreach ($gradeIds as $gradeId) {
            // createでfactory()が作られてる
            Curriculums::factory()->create([
                'grade_id' => $gradeId,
            ]);
        }
    }
}
