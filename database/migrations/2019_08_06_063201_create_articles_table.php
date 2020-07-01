<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->integer('status')->comment('文章状态,1编辑中,2已发布,3已删除');
            $table->string('title')->comment('文章标题');
            $table->longText('md_content')->comment('markdown格式的文章');
            $table->longText('html_content')->comment('html格式的文章');
            $table->string('description')->comment('文章导读或者简介')->default("");
            $table->integer('favor_num')->comment('文章的点赞总数')->default(0);
            $table->integer('collection_num')->comment('文章的收藏总数')->default(0);
            $table->integer('read_num')->comment('文章的阅读数')->default(0);
            $table->integer('comment_num')->comment('文章的评论数')->default(0);
            $table->index(['status']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
