<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function showProfileForm()
   {
        $userId = 1; //仮でユーザーIDは1に設定する。
        //$userId = Auth::id(); //ログインユーザーIDを取得。
        $user = User::find($userId);

        return view('user.profile_edit',compact('user'));
    }

    public function profileEdit(ProfileRequest $request)
   {
        $userId = 1; //仮でユーザーIDは1に設定する。
        //$userId = Auth::id(); //ログインユーザーIDを取得。
$user = User::find($userId);
        try {
            DB::beginTransaction();

            $model = new User;
            $model->updateProfile($request, $userId);

            DB::commit();
            return redirect()->route('user.show.profile')->with('success', 'プロフィールが更新されました');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back();
        }

    }
    public function showPasswordForm()
   {
        $userId = 1; //仮でユーザーIDは1に設定する。
        //$userId = Auth::id(); //ログインユーザーIDを取得。
        $user = User::find($userId);

        return view('user.password_edit',compact('user'));
    }

        public function passwordEdit(PasswordRequest $request)
   {
        $userId = 1; //仮でユーザーIDは1に設定する。
        //$userId = Auth::id(); //ログインユーザーIDを取得。
        $user = User::find($userId);
        try {
            DB::beginTransaction();

            if ($request->current_password !== $user->password) {
                return back()->withErrors(['current_password' => '現在のパスワードが間違っています。'])->withInput();
            }else{
                $user->updatePassword($request->new_password); 
            }
            
            DB::commit();
            return redirect()->route('user.show.profile')->with('success', 'プロフィールが更新されました');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back();
        }

    }
}
