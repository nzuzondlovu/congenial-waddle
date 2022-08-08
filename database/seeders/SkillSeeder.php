<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $skills = [
            'Bash',
            'C#',
            'C++',
            'Go',
            'Java',
            'JavaScript',
            'Kotlin',
            'PHP',
            'Python',
            'Ruby',
            'SQL',
            'TypeScript',
        ];

        foreach ($skills as $skill) {
            Skill::create([
                'name' => $skill
            ]);
        }
    }
}
