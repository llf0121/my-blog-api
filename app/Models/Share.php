<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Share extends Model
{
    protected $table = 'shares';

    protected $fillable = ['user_id','uuid','ip','share_type','share_id','client'];


    /**
     * 获取拥有此点赞的模型。
     */
    public function shareable()
    {
        return $this->morphTo();
    }

}
