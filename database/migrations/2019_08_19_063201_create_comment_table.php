<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('content')->comment('评论内容');
            $table->integer('article_id')->comment('文章的id');
            $table->integer('parent_id')->comment('父级评论的id')->default("0");
            $table->integer('super_parent_id')->comment('顶级评论的id')->default("0");
            $table->integer('user_id')->comment('发表评论的用户id');
            $table->integer('favor_num')->comment('评论的点赞数')->default(0);
            $table->smallInteger('status')->comment('评论的状态，1代表已删除 0代表正常')->default(0);
            $table->index('article_id');
            $table->index('super_parent_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
