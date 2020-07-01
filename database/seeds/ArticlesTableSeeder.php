<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 所有用户 ID 数组，如：[1,2,3,4]
        $users = User::get(['id','department_id'])->toArray();

        // 获取 Faker 实例
        $faker = app(Faker\Generator::class);

         $articles = factory(\App\Models\Article::class)
            ->times(100)
            ->make()
            ->each(function ($article)
            use ($users, $faker)
            {
                $user = $faker->randomElement($users);
                // 从用户 ID 数组中随机取出一个并赋值
                $article->user_id = $user['id'];
                $article->department_id = $user['department_id'];
            });

         \App\Models\Article::insert($articles->toArray());
    }
}
