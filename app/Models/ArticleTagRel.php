<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleTagRel extends Model
{
    protected $table = 'article_tag_rel';

    protected $fillable = ['id','article_id','tag_id','created_at','updated_at'];

}
