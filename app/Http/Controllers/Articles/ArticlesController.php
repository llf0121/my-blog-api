<?php

namespace App\Http\Controllers\Articles;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Http\Services\TagService;
use App\Models\Article;
use App\Transformers\ArticleTransformer;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{

    public function index(Request $request, ArticleTransformer $transformer)
    {
        $articles= Article::paginate($request->input('page_size'));
        return $this->response->paginator($articles,$transformer);
    }


    public function store(ArticleRequest $request, TagService $tagService)
    {
        $params = $request->only(['title', 'md_content', 'html_content','status']);
        $tag_ids = collect($request->input('tags'))->map(function ($tag) use ($tagService) {
            $result = $tagService->getOrInsertTag($tag);
            return $result->id;
        })->toArray();
        $article = Article::create($params);
        $article->tags()->attach($tag_ids);
        return $this->success($article->toArray());
    }


    public function show(Article $article)
    {
        $article->setHidden(['md_content']);
        return $this->success($article->toArray());
    }

    public function edit(Article $article)
    {
        return $this->success($article->toArray());
    }

    public  function update(Article $article,ArticleRequest $request, TagService $tagService)
    {
        $params = $request->only(['title', 'md_content', 'html_content','status']);
        $tag_ids = collect($request->input('tags'))->map(function ($tag) use ($tagService) {
            $result = $tagService->getOrInsertTag($tag);
            return $result->id;
        })->toArray();
        $article->tags()->detach();
        $article->update($params);
        $article->tags()->attach($tag_ids);
        $this->success();
    }
}
