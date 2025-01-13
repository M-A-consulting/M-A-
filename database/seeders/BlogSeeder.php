<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Blog::factory()->count(10)->create();
        // Blog::create([
        //     'title' => 'Sample Blog Title',
        //     'subtitle' => 'Sample Subtitle',
        //     'content' => 'This is a sample content for the blog.',
        //     'published_at' => now(),
        //     'company_name' => 'Sample Company',
        //     'video_url' => 'https://example.com/video',
        // ]);
    }
}
