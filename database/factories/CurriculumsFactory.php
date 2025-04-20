<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Curriculums;
use Faker\Generator as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Curriculums>
 */
class CurriculumsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $topics = [
            '変数', '関数', 'クラス', 'オブジェクト指向', 'デバッグ', '配列', 'ループ', '条件分岐',
            'API', 'データベース', 'Git', 'Laravel', 'PHP', 'JavaScript', 'HTML', 'CSS',
            'REST API', 'Ajax', 'SQL', 'セキュリティ', '認証', 'ルーティング', 'MVC', 'バリデーション'
        ];

        $verbs = [
            'の基本', 'を学ぶ', 'とは？', 'の書き方', '徹底解説', '入門編', '実践講座', '基礎から応用まで',
            'のベストプラクティス', 'の使いどころ', 'でつまづかないために', 'あるあるミス', '最速マスター法'
        ];

        $title = $this -> faker -> randomElement($topics) . $this -> faker -> randomElement($verbs);

        return [
            'title' => $title,
            'thumbnail' => 'storage/images/' . $this->faker->image(
                storage_path('app/public/images'),
                320,
                240,
                'technics', // プログラミング系のカテゴリ
                false //フルパスではなくファイル名だけ返す
            ),
            'description' => $this->faker->sentence(),
            'video_url' => $this->faker->url(),
            'always_delivery_flg' => $this->faker->boolean(80), // 80%の確率でtrue
            // grade_idはランダムに偏らないようにするためにseederで指定する（factoryでは偏りのバランスが指定できない）
            // 'grade_id' => $this->faker->numberBetween(1, 12)
        ];
    }
}
