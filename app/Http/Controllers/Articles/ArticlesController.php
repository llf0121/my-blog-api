<?php

namespace App\Http\Controllers\Articles;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Http\Services\TagService;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{

    public function index(Request $request)
    {
//        $params = $request->input();
        return Article::paginate();
    }


    public function store(ArticleRequest $request, TagService $tagService)
    {
        $params = $request->only(['title', 'md_content', 'html_content','status']);
        $tag_ids = collect($request->input('tags'))->map(function ($tag) use ($tagService) {
            $result = $tagService->getOrInsertTag($tag);
            return $result->id;
        })->toArray();
        $articles = Article::create($params);
        $articles->tags()->attach($tag_ids);
        $this->success();
    }
}
