<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AddAdminMenuTableSeeder extends Seeder
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
                'title' => "评论管理",
                'icon' => "fa-comment",
                'uri' => "/comments",
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now()
            ],
        ]);
    }
}
