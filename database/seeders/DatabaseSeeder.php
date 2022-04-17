<?php

namespace Database\Seeders;

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
        // \App\Models\User::factory(10)->create();
        $this->call(\Database\Seeders\Roles_seeder::class);
        $this->call(\Database\Seeders\User_seeder::class);
    }
}
