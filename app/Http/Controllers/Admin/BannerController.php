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

        $newBanners = $request->file('banners', []);
        $existingBannersCount = \App\Models\Banner::count();

        // 新規追加も削除もない場合のみリダイレクト
        if (count($newBanners) === 0 && !$request->filled('deleted_banners')) {
            return redirect()->back();
        }

        DB::beginTransaction();

        try {
            $deletedCount = count($request->input('deleted_banners', []));
            $remainingBanners = Banner::count() - $deletedCount;

            if ($remainingBanners <= 0 && empty($newBanners)) {
                // 削除して0枚になる場合は処理中断
                return redirect()->back()->withErrors(['banners' => 'バナーは最低1枚以上残す必要があります。']);
            }
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