<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Article extends Model
{
    use HasFactory;

    public function updateArticle($data,$id){
        $updateData=[
            'posted_date' => $data->postedDate,
            'title' => $data->title,
            'article_contents' => $data->contents,
            

        ];
        DB::table('articles')->where('id', $id)->update($updateData);
    }
}
