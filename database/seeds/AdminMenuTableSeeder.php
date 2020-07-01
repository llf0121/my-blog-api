<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AdminMenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin_menu')->insert([
            [
                'parent_id'=> 0,
                'title' => "文章管理",
                'icon' => "fa-book",
                'uri' => "/articles",
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now()
            ],
            [
                'parent_id'=> 0,
                'title' => "标签管理",
                'icon' => "fa-certificate",
                'uri' => "/tags",
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now()
            ],
            [
                'parent_id'=> 0,
                'title' => "部门管理",
                'icon' => "fa-object-ungroup",
                'uri' => "/departments",
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now()
            ],

            [
                'parent_id'=> 0,
                'title' => "用户管理",
                'icon' => "fa-user",
                'uri' => "/users",
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now()
            ],
        ]);
    }
}
