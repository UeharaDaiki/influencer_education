<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\Article;
use App\Models\Curriculum;
use App\Models\CurriculumProgress;
use App\Models\Curriculums;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function showArticleList()
   {
        $articles = Article::all();
        foreach($articles as $article){
            $PostedDate = new Carbon($article->posted_date);
            $PostedDate = $PostedDate->format('Y年m月d日');
            $article->posted_date = $PostedDate;
        }

        // 一時的
        return view('admin.article',compact('articles'));
    }
    public function showArticleCreate()
    { 
         // 一時的
         return view('admin.article_edit');
     }
    public function showArticleDelete($id)
    { 
        try {
            $product = Article::find($id);
    
            if ($product) {
                // 商品をDBから削除
                $product->delete();
                return response()->json([
                    'success' => true,
                    'message' => 'お知らせが削除されました。',
                    'redirect_url' => route('admin.show.article.list')
                ]);
            }
    
            return response()->json([
                'success' => false,
                'message' => 'お知らせが見つかりません。',
            ]);
        } catch (\Exception $e) {
            
            return response()->json([
                'success' => false,
                'message' => 'お知らせ削除中にエラーが発生しました。後ほどもう一度試してください。',
            ]);
        }

        return view('admin.article');
    }

    public function showArticleEdit($id)
    {
        $article=Article::find($id);
        
        $article->posted_date = \Carbon\Carbon::parse($article->posted_date)->format('Y-m-d');

        return view('admin.article_edit',compact("article"));
    }

    public function articleEdit(Request $request,$id)
    {
        $model=new Article;
        $model->updateArticle($request,$id);
        return redirect()->route('admin.show.article.edit', ['id' => $id]);        
    } 
}
