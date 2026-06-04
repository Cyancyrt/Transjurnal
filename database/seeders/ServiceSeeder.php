<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('services')->insert([
            [
                'name' => 'Basic Translation',
                'description' => 'Translation only',
                'base_price' => 50000,
            ],
            [
                'name' => 'Translation + Summary',
                'description' => 'Translation with summary',
                'base_price' => 100000,
            ],
            [
                'name' => 'Academic Insight',
                'description' => 'Translation, summary and key points',
                'base_price' => 150000,
            ],
        ]);
    }
}
