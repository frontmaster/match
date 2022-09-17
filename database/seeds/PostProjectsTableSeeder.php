<?php

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 100; $i++){

            DB::table('postProjects')->insert([
                ['title' => $i . '番目のtest', 'content' => $i . '番目のtest', 'post_user_id' => '9',
                'category_id' => '2', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]
            ]);
        }
    }
}
