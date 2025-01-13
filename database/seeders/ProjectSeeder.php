<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Project::create([
            'title' => 'doit',
            'subtitle' => 'Earn money from the comfort of your desktop',
            'launch_date' => '2024/11/11',
            'company_name' => 'MA',
            'video' => 'https://example.com/project-one-video',
            'content' => '<p>This is the content for Project One.</p>',
        ]);
        // Project::factory(10)->create();
    }
}
