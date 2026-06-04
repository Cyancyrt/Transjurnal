<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    public function definition(): array
    {
        $fields = [

            'Computer Science',

            'Medicine',

            'Law',

            'Economics',

            'Psychology'
        ];

        $languages = [

            'English',

            'Japanese',

            'Chinese',

            'German',

            'French'
        ];

        return [

            'user_id' =>
                User::where(
                    'role',
                    'user'
                )
                ->inRandomOrder()
                ->first()
                ->id,

            'translator_id' => null,

            'service_id' =>
                fake()->numberBetween(1,3),

            'field' =>
                fake()->randomElement(
                    $fields
                ),

            'title' =>
                fake()->sentence(),

            'description' =>
                fake()->paragraph(),

            'source_language' =>
                fake()->randomElement(
                    $languages
                ),

            'target_language' =>
                fake()->randomElement([
                    'English',
                    'Indonesian'
                ]),

            'journal_file' =>
                'journals/sample.pdf',

            'translated_file' =>
                null,

            'price' =>
                fake()->randomElement([
                    50000,
                    100000,
                    150000
                ]),

            'status' =>
                fake()->randomElement([
                    'open',
                    'in_progress',
                    'completed'
                ])
        ];
    }
}