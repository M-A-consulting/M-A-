<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'title' => 'The Complete ECommerce Solution',
            'subtitle' => 'Boost your online sales and simplify management with high-performance eCommerce platform',
            'launch_date' => now(),
            'company_name' => 'M&A',
            'video' => 'https://example.com/sample-video',
            'content' => '<h3>Sample product content here...</h3>',
        ]);
    }
}
