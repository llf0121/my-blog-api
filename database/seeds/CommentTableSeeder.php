<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 所有用户 ID 数组，如：[1,2,3,4]
        $user_ids = User::all()->pluck('id')->toArray();
        $article_ids  = \App\Models\Article::all()->pluck('id')->toArray();

        // 获取 Faker 实例
        $faker = app(Faker\Generator::class);

        $comments = factory(\App\Models\Comment::class)
            ->times(100)
            ->make()
            ->each(function ($comment)
            use ($user_ids,$article_ids, $faker)
            {
                // 从用户 ID 数组中随机取出一个并赋值
                $comment->user_id = $faker->randomElement($user_ids);
                $comment->article_id = $faker->randomElement($article_ids);
                $comment->parent_id = 0;
                $comment->super_parent_id = 0;
            });

        \App\Models\Comment::insert($comments->toArray());

    }
}
