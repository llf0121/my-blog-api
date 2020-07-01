<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';

    protected $fillable = ['content','article_id','parent_id','super_parent_id','user_id','created_at','updated_at','favor_num','status'];

    const  STATUS_INIT = 0; //正常状态
    const  STATUS_DELETE = 1; //已删除


    public function shares()
    {
        return $this->morphMany('App\Models\Share', 'shareable');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function child()
    {
        return $this->hasMany('App\Models\Comment', 'super_parent_id', 'id');
    }


    public function father()
    {
        return $this->belongsTo('App\Models\Comment', 'parent_id', 'id');
    }


    public static function getCommentTree($comments, $pid)
    {
        $ret = [];
        foreach ($comments as $k=>$v){
            if($v['super_parent_id'] == $pid){
                $data = self::getCommentTree($comments,$v['id']);
                if(count($data)){
                    $v['children'] = $data;
                }
                $ret[]=$v;
            }
        }
        return $ret;
    }

    public function setFavorUser($user_id)
    {
        $this->favor_user = $user_id;
        return $this;
    }

    public function getIsFavoredAttribute()
    {
        if(!$this->favor_user){
            return false;
        }
        $count = Share::where(['share_type' => 2 ,'user_id' => $this->favor_user , 'share_id' => $this->id])->count();
        if($count){
            return true;
        }else{
            return false;
        }
    }


    public function getToUserAttribute()
    {
        $father = $this->father;
        if($father){
            return [
                'id' => $father->user->id,
                'name' => $father->user->name,
                'nickname' => $father->user->nickname,
                'email' => $father->user->email,
            ];
        }
        return [
            'id' => 0,
            'name' => "",
            'nickname' =>  "",
            'email' =>  "",
        ];
    }

    public function getContentAttribute($value)
    {
        return  $this->status == Comment::STATUS_DELETE ? " " : $value;
    }

    public function getStatusNameAttribute()
    {
        $words = [
            Comment::STATUS_INIT  =>'正常',
            Comment::STATUS_DELETE =>'已删除',
        ];
        return $words[$this->status];
    }
}
