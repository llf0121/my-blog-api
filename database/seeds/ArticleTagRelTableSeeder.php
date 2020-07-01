<?php

use Illuminate\Database\Seeder;
use App\Models\Tag;
use App\Models\Article;
use App\Models\ArticleTagRel;

class ArticleTagRelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = Tag::all()->pluck('id')->toArray();
        $articles = Article::all()->pluck('id')->toArray();
        // 获取 Faker 实例
        $faker = app(Faker\Generator::class);
        $rels = factory(ArticleTagRel::class)
            ->times(20)
            ->make()
            ->each(function ($rel)
            use ($tags,$articles,$faker)
            {
                // 从用户 ID 数组中随机取出一个并赋值
                $rel->article_id = $faker->randomElement($articles);
                $rel->tag_id = $faker->randomElement($tags);
            });
        ArticleTagRel::insert($rels->toArray());

    }
}
