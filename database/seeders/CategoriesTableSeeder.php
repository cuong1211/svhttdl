<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            ['title' => 'News', 'slug' => 'news', 'user_id' => 1],
            ['title' => 'About', 'slug' => 'about', 'user_id' => 1],
        ]);
    }
}
