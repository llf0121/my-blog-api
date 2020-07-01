<?php

namespace  App\Http\Services;

use App\Models\Tag;

class TagService
{
    public  function getOrInsertTag($tag)
    {
       return  Tag::where('id', $tag)->firstOr(function () use ($tag) {
            $new_tag = Tag::create(['name' => $tag]);
            return $new_tag;
        });
    }

}
