<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $categories = [
            ['name' => 'Pay Per Click'],
            ['name' => 'Search Engine Optimization'],
            ['name' => 'Social Media Marketing'],
            ['name' => 'Social Media Management'],
            ['name' => 'SEO Content Writing'],
            ['name' => 'SEO Audit'],
            ['name' => 'IOS App Development'],
            ['name' => 'Android App Development'],
            ['name' => 'Custom Website Design'],
            ['name' => 'Wordpress Website Design'],
            ['name' => 'UI/UX Design'],
            ['name' => 'Front-end Development'],
            ['name' => 'Backend Development'],
            ['name' => 'Custom CRM Development'],
            ['name' => 'Other CMS Web Design'],
            ['name' => 'Video Editing & Motion Graphics'],
            ['name' => '2D & 3D Animation'],
            ['name' => 'eCommerce Website Design'],
            ['name' => 'WooCommerce Store Development'],
            ['name' => 'Shopify Store Development'],
            ['name' => 'eCommerce Marketing'],
            ['name' => 'Logo Design'],
            ['name' => 'Brand Identity'],
            ['name' => 'Complete Graphics Design Services']
        ];

        Category::insert($categories);
    }
}
