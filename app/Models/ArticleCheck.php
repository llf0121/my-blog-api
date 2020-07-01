<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleCheck extends Model
{
    protected $table = 'article_checks';

    protected $fillable = ['id','article_id','operator','reason','type'];

    const  ARTICLE_PASS = 1; //审核通过
    const  ARTICLE_UNPASS = 2; //审核未通过

}
