<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Product::factory()->create([
            'id' => Str::uuid(),
            'title' => 'Iphone 16 Pro Max',
            'price' => 190000.00,
        ]);

        Product::factory()->create([
            'id' => Str::uuid(),
            'title' => 'Iphone 15',
            'price' => 90000.00,
        ]);

        Product::factory()->create([
            'id' => Str::uuid(),
            'title' => 'Iphone 11',
            'price' => 40000.00,
        ]);

//        Product::factory()->count(10)->create();
    }
}
