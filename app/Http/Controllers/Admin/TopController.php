<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TopController extends Controller
{
    public function showTop() 
    {
        // 管理ユーザーのIDを取得
        $adminId = Auth::guard('admin')->id();

        // 管理ユーザーの情報を取得
        $adminUser = Auth::guard('admin')->user();

        $name = $adminUser->name; // ログインしたユーザーの名前を取得
        $email = $adminUser->email; // ログインしたユーザーのメールアドレスを取得
        // トップ画面を表示
        return view('admin.top', compact('name', 'email'));
    }
}
