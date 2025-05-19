<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Curriculum;
use Illuminate\Support\Facades\Auth;

class DeliveryController extends Controller
{
    public function showDelivery($id)
    {
        // 関連モデルをまとめて取得
        $curriculum = Curriculum::with(['grade', 'deliveryTimes', 'progress'])->findOrFail($id);

        // モデルメソッドで判定
        $isDelivered = $curriculum->isDelivered();

        // 進捗状況を取得（where句はモデル内で適用済みなので first() だけでOK）
        $progress = $curriculum->progress->first();
        $isCompleted = $progress && $progress->clear_flg == 1;

        return view('Users.auth.delivery', compact('curriculum', 'isDelivered', 'isCompleted'));
    }
}
