<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'departments';

    protected $fillable = ['id','name','brief_name'];

    public function  articles()
    {
        return $this->hasOne('App\Models\Article');
    }

}
