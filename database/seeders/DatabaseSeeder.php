<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\User\Categorie as UserCategorie;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        UserCategorie::create([
            'name'=> 'Admin',
            'slug'=>'admin',
        ]);
        User::factory()->create([
            'name' => 'Cuong',
            'email' => 'Cuong1@gmail.com',
            'password' => 'cuong1211',
            'display_name' => 'Cuong',
            'category_id' => 1,
        ]);

        // $this->call([
        //     CategoriesTableSeeder::class,
        //     PostsTableSeeder::class,
        //     TagsTableSeeder::class,
        //     PostTagsTableSeeder::class,
        // ]);
    }
}
