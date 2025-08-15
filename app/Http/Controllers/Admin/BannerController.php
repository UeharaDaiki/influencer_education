<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BannerStoreRequest;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class BannerController extends Controller
{
    public function showBannerEdit()
    {
        $banners = Banner::all();
        // バナー登録フォームを表示
        return view('admin.banner_edit', compact('banners'));
    }

    public function store(BannerStoreRequest $request)
    {

        DB::beginTransaction();

        try {
            // 1. 削除対象の既存バナーがあれば削除
            if ($request->filled('deleted_banners')) {
                foreach ($request->input('deleted_banners') as $bannerId) {
                    $banner = Banner::find($bannerId);
                    if ($banner) {
                        if (Storage::disk('public')->exists($banner->image)) {
                            Storage::disk('public')->delete($banner->image);
                        }
                        $banner->delete();
                    }
                }
            }
            
            // 2. 新しいバナー画像のアップロード
            if ($request->hasFile('banners')) {
                foreach ($request->file('banners') as $file) {
                    if ($file && $file->isValid()) {
                        //　保存ファイル名作成
                        $filename = time() . '_' . $file->getClientOriginalName();
                        //　ファイル保存
                        $path = $file->storeAs('images/banners', $filename, 'public');
                       
                        //　DBに保存
                        Banner::create([
                            'image' => $path
                        ]);

                         Log::info('Banner image uploaded: ' . $path);

                    }
                }
            }

            DB::commit();
            return redirect()->back()->with('success', 'バナーをアップロードしました。');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error storing banner: ' . $e->getMessage());
            return redirect()->back()->withErrors(['banners' => 'バナーのアップロードに失敗しました。']);
        }
    }
}