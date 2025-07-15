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
        $categories = \App\Models\FadhilCategory::all();
        FadhilBooks::factory()->count(50)->create()->each(function ($book) use ($categories) {
            
            $book->categories()->attach(
                $categories->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
    }
}
