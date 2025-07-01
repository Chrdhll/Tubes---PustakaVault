<?php

namespace Database\Seeders;

use App\Models\FadhilBooks;
use App\Models\FadhilCategory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoryIds = FadhilCategory::pluck('id');

        FadhilBooks::factory()->count(50)->create([
            'category_id' => function () use ($categoryIds) {
                return $categoryIds->random();
            }
        ]);
    }
}
