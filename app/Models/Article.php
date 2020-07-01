<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'articles';

    protected $fillable = ['id','author','status','title','md_content','html_content','description','favor_num','collection_num','read_num', 'comment_num','type','user_id',];


    const  STATUS_EDIT = 1; //编辑中
    const  STATUS_CHECK = 2; //待审核
    const  STATUS_PUBLISH = 3; //已发布
    const  STATUS_DELETE = 4; //已删除


//    public $appends = ['markdown_content'];

    public function  tags()
    {
        return $this->belongsToMany('App\Models\Tag', 'article_tag_rel', 'article_id', 'tag_id');
    }

    public function file()
    {
        return $this->hasOne(UploadFiles::class,'article_id','id')->withDefault([
            'id' => 0,
            'path' => ""
        ]);
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }


    public function shares()
    {
        return $this->morphMany('App\Models\Share', 'shareable');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id')->withDefault([
            'name' => '暂无',
            'id' => '0'
        ]);
    }


    /*
     * 设置markdown_content的源码时，要把代码段的```转义一次,\`\`\`
     *
     * @param  string  $value
     * @return void
     */

    public function getMarkdownContentAttribute()
    {
        //匹配`
        $cont = preg_replace ('/`/', '\`', $this->md_content);
        //匹配 < \ />
        $cont =  preg_replace ('/</', '\<', $cont);
        $cont =  preg_replace ('/>/', '\>', $cont);
        return $cont;
    }


    public  function  canCheck()
    {
        return  $this->status == self::STATUS_CHECK;
    }

    public function  canEdit()
    {
        return  $this->status != self::STATUS_CHECK;
    }


    public function scopeYear($query,$value)
    {
        return $query->where([
            ['created_at','>=',$value.'-01-01 00:00:00'],
            ['created_at','<=',$value.'-12-31 23:59:59']
        ]);
    }

    public function scopeTags($query,$value)
    {
        return $query->whereHas('tags',function($q) use ($value){
                $q->whereIn('tag_id',$value);
        });
    }

    public function scopeType($query,$value)
    {
        return $query->whereIn('type', explode(",",$value));
    }


    public function getCreateAttribute()
    {
        return  date("Y",strtotime($this->created_at));
    }

    public function getFileUrlAttribute()
    {
        return  $this->file->id? route('api.download',['type'=>'file', 'id'=> $this->file->id]):"";
    }

    public function getFileIdAttribute()
    {
        return  $this->file->id;
    }
}
