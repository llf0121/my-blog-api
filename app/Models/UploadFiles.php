<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UploadFiles extends Model
{
    protected $table = 'upload_files';
    protected $fillable = ['id','path','article_id','url'];

}
