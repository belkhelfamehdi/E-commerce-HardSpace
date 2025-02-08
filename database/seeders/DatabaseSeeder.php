<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(1)->create();
        \App\Models\Admin::factory()->create();
        \App\Models\Brand::factory(5)->create();
        \App\Models\Product::factory(40)->create();
        \App\Models\Category::factory(5)->create();
    }
}
