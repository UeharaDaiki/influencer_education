<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class BannerController extends Controller
{
    public function showBannerEdit()
    {
        $banners = Banner::all();
        // バナー登録フォームを表示
        return view('admin.banner_edit', compact('banners'));
    }

    public function store(Request $request)
    {
        if ($request->hasFile('banners')) {
            foreach ($request->file('banners') as $file) {
                if ($file && $file->isValid()) {
                    $path = $file->store('images/banners', 'public'); // publicディスクに保存
                    // オリジナル名取得
                    $originalName = $file->getClientOriginalName();
                    
                    $originalName = $file->getClientOriginalName();
                    $filename = time() . '_' . $originalName;
                    $path = $file->storeAs('images/banners', $filename, 'public');

                    // DB登録
                    Banner::create([
                        'image' => $path,
                    ]);
                }
            }
            // 登録完了後のリダイレクト
            return redirect()
            ->route('admin.show.banner.edit') // バナー編集画面にリダイレクト
            ->with('success', 'バナーが登録されました');
        }
        // ファイルがアップロードされていない場合のエラーメッセージ
        return redirect()->back()->withErrors(['banners' => 'バナー画像をアップロードしてください。']);
    }

    public function delete(Request $request)
    {
        Log::info('Delete method called with id: ' . $request->id);
        $banner = Banner::find($request->id);
        if ($banner) {
            Storage::disk('public')->delete($banner->image); // 画像ファイルを削除
            $banner->delete(); // DBから削除
            
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 404); // バナーが見つからない場合のエラーレスポンス
    }
}