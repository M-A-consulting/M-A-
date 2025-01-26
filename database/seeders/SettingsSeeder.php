<?php

namespace Database\Seeders;

use App\Models\Settings;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Settings::create([
            'company_name' => 'M&A',
            'logo' => 'logo.jpg',
            'about' => 'About the company.',
            'founded_date' => now(),
            'email' => 'M&A@example.com',
            'phone' => '01064209849',
            'address' => 'Alexandria, Egypt',
            'social_links' => json_encode(['facebook' => 'https://facebook.com', 'twitter' => 'https://twitter.com']),
            'services_offered' => 'Our services include web development, marketing, etc.',
            'clients' => 'Client A, Client B, etc.',
            'testimonials' => 'Testimonial 1, Testimonial 2, etc.',
            'awards' => 'Award 1, Award 2, etc.',
            'team_members' => json_encode([['name' => 'Alaa Rezk', 'position' => 'Software Developer']]),
            'founder' => 'Aly Mansy',
            'certifications' => 'ISO 9001, etc.',
        ]);
    }
}
