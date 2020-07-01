<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSharesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shares', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->index()->default(0)->comment('会员ID');
            $table->uuid('uuid')->comment('设备UUID')->nullable();
            $table->ipAddress('ip')->index()->comment('ip地址');
            $table->string('share_type', 20)->default('')->comment('类型 1=文章 2=评论');
            $table->integer('share_id')->default(0)->comment('物件ID');
            $table->string('client')->default('web');
            $table->index(['share_type', 'share_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shares');
    }
}
