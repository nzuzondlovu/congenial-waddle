<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\SkillSeeder;
use Database\Seeders\CountrySeeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(SkillSeeder::class);
        $this->call(CountrySeeder::class);
    }
}
