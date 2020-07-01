<?php

namespace App\Http\Controllers\Tags;

use App\Http\Request\TagRequest;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class TagsController extends Controller
{
    public function index(Request $request)
    {
        $tags = Tag::withCount(['articles'])->paginate($request->input('page_size',15));
        return $this->success($tags->toArray());
    }


    public function store(TagRequest $request)
    {
        $tags = Tag::create([
            'name' => $request->input('name')
        ]);
        return $this->success($tags->toArray());
    }
}
