<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Admin
        |--------------------------------------------------------------------------
        */

        User::create([
            'name' => 'Administrator',
            'email' => 'admin@scholarbridge.test',
            'password' => Hash::make('password'),
            'role' => 'admin'
        ]);

        /*
        |--------------------------------------------------------------------------
        | Translators
        |--------------------------------------------------------------------------
        */

        $translators = [

            'Dr. John Translator',
            'Prof. Michael Chen',
            'Dr. Sarah Williams',
            'Prof. Ahmad Hidayat',
            'Dr. Emily Carter',
            'Prof. Yuki Tanaka',
            'Dr. David Kim',
            'Prof. Maria Gonzalez'

        ];

        foreach($translators as $index => $name)
        {
            User::create([
                'name' => $name,

                'email' =>
                    'translator'.$index.'@scholarbridge.test',

                'password' =>
                    Hash::make('password'),

                'role' => 'translator'
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Users
        |--------------------------------------------------------------------------
        */

        for($i=1; $i<=20; $i++)
        {
            User::create([

                'name' =>
                    'Research Student '.$i,

                'email' =>
                    'user'.$i.'@scholarbridge.test',

                'password' =>
                    Hash::make('password'),

                'role' =>
                    'user'
            ]);
        }
    }
}