<?php

namespace App\Transformers;

use App\Models\Article;

class ArticleTransformer extends BaseTransformer
{
//    protected  $a


    public function  transform(Article $article)
    {
        $route = request()->route()->getName();
        switch($route){
            case "api.articles.index":
                $data = $this->transformIndex($article);
                break;
        }
        return $data;
    }


    protected  function  transformIndex(Article $article)
    {
        return [
            'title'       => $article->title,
            'content'     => $article->html_content,
            'description' => $article->description,
        ];
    }

}
