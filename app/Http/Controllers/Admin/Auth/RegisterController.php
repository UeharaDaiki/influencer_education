<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AdminRequest;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        // ユーザー新規登録画面を表示
        return view('admin.auth.register');
    }

    public function store(AdminRequest $request)
    {
        // バリデーションを通過したデータを取得
        $validatedData = $request->validated();
        // 管理者の新規登録処理
        Admin::create([
            'name' => $validatedData['name'],
            'name_kana' => $validatedData['name_kana'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']), // パスワードをハッシュ化
        ]);

        // 登録完了後のリダイレクト
        return redirect()->route('admin.show.register')->with('success', '管理者アカウントが作成されました。');

    }
}
