<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\User\Categorie as UserCategorie;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Staff\Department;
use App\Models\Staff\Position;
use App\Models\Staff\Staff;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // Department::factory(10)->create();
        // Position::factory(20)->create();
        // Staff::factory(30)->create();
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin123@gmail.com',
            'password' => 'admin123',
            'display_name' => 'admin',
            'category_id' => 1,
            'state' => 1,
        ]);
    }
}
