<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FadhilBooks>
 */
class FadhilBooksFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        if (!Storage::disk('public')->exists('books')) {
            Storage::disk('public')->makeDirectory('books');
        }

        try {
            $imageUrl =  'https://picsum.photos/seed/' . Str::random(10) . '/400/600';
            $imageContent = file_get_contents($imageUrl);
        } catch (\Exception $e) {
            $imageContent = file_get_contents(storage_path('app/public/default.jpg'));
        }

        $imageName = 'books/' . Str::uuid() . '.jpg';

        Storage::disk('public')->put($imageName, $imageContent);

        return [
            'title' => $this->faker->sentence(3),
            'author' => $this->faker->name(),
            'publisher' => $this->faker->company(),
            'year' => $this->faker->year(),
            'blurb' => $this->faker->paragraph(5),
            'stock' => $this->faker->numberBetween(1, 20),
            'image' => $imageName,
        ];
    }
}
