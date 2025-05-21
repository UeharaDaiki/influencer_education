<?php
namespace App\Consts;

class GradeTitles
{
    const ELEMENTARY_MAX = 6; // 小学校最高学年
    const ELEMENTARY_AND_JUNIORHIGH = 9; // 小学校と中学校の学年数
    const HIGH_SCHOOL_MIN = 10; // 高校最低学年

    // 学年名の定義
    const GRADE = [
        1 => '小学1年生',
        2 => '小学2年生',
        3 => '小学3年生',
        4 => '小学4年生',
        5 => '小学5年生',
        6 => '小学6年生',
        7 => '中学1年生',
        8 => '中学2年生',
        9 => '中学3年生',
        10 => '高校1年生',
        11 => '高校2年生',
        12 => '高校3年生'
    ];
}