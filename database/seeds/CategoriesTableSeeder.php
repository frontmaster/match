<?php

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['category_name' => '単発', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['category_name' => 'レベニューシェア', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]
        ]); 
    }
}
