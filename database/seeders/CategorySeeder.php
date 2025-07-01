<?php

namespace Database\Seeders;

use App\Models\FadhilCategory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Fiksi Ilmiah', 'Fantasi', 'Misteri', 'Horor', 'Roman', 
            'Biografi', 'Sejarah', 'Pengembangan Diri', 'Teknologi'
        ];

        foreach ($categories as $category) {
            FadhilCategory::create(['name' => $category]);
        }
    }
}
