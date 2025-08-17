<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use App\Http\Requests\AdminRequest;
use App\Models\Admin;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        // ログイン画面を表示
        return view('admin.auth.login');
    }

    public function login(AdminLoginRequest $request)
    {
        // バリデーションを通過したデータを取得
        $validatedData = $request->validated();

        // 管理者の認証処理
        if (auth()->guard('admin')->attempt(['email' => $validatedData['email'], 'password' => $validatedData['password']])) {
            // 認証成功時のリダイレクト
            return redirect()->route('admin.show.top')->with('success', 'ログインしました。');
        }

        // 認証失敗時のリダイレクト
        return redirect()->back()->withErrors(['email' => 'メールアドレスまたはパスワードが間違っています。']);
    }
}
