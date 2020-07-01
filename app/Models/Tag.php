<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tags';

    protected $fillable = ['id','name'];

    public $hidden = [
        'pivot'
    ];

    public function  articles()
    {
        return $this->belongsToMany('App\Models\Article', 'article_tag_rel', 'tag_id','article_id');
    }


}
