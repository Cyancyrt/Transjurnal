<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::where('role', 'user')->pluck('id');

        Order::create([

            'user_id' => $users->random(),

            'translator_id' => null,

            'service_id' => 1,

            'field' => 'Computer Science',

            'title' => 'Artificial Intelligence Research Paper',

            'description' =>
                'Translation of AI paper from English to Indonesian.',

            'source_language' => 'English',

            'target_language' => 'Indonesian',

            'journal_file' =>
                'journals/ai-paper.pdf',

            'translated_file' => null,

            'price' => 50000,

            'status' => 'open'
        ]);
    }
}