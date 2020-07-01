<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleTagRelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_tag_rel', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->integer('article_id')->comment('文章id');
            $table->integer('tag_id')->comment('标签id');
            $table->index(['article_id','tag_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article_tag_rel');
    }
}
