<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UsersTableSeeder::class);
         $this->call(TagsTableSeeder::class);
         $this->call(ArticlesTableSeeder::class);
         $this->call(ArticleTagRelTableSeeder::class);
         $this->call(CommentTableSeeder::class);
          $this->call(\Encore\Admin\Auth\Database\AdminTablesSeeder::class);
          $this->call(AdminMenuTableSeeder::class);
          $this->call(AdminPermissionTableSeeder::class);
    }
}
