<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\TranslatorProfile;
use Illuminate\Database\Seeder;

class TranslatorProfileSeeder extends Seeder
{
    public function run(): void
    {
        $profiles = [

            [
                'academic_title' => 'Doctor',
                'university' => 'Massachusetts Institute of Technology',
                'expertise' => 'Computer Science',
                'languages' => 'English, Indonesian',
                'publication_count' => 12,
                'hourly_rate' => 150000,
                'verification_status' => 'approved',
                'bio' => 'Researcher in artificial intelligence and software engineering.'
            ],

            [
                'academic_title' => 'Professor',
                'university' => 'Stanford University',
                'expertise' => 'Machine Learning',
                'languages' => 'English, Chinese',
                'publication_count' => 27,
                'hourly_rate' => 250000,
                'verification_status' => 'approved',
                'bio' => 'Professor specializing in machine learning and data science.'
            ],

            [
                'academic_title' => 'Doctor',
                'university' => 'University of Oxford',
                'expertise' => 'Medical Science',
                'languages' => 'English',
                'publication_count' => 18,
                'hourly_rate' => 200000,
                'verification_status' => 'approved',
                'bio' => 'Medical researcher focusing on cancer treatment studies.'
            ],

            [
                'academic_title' => 'Professor',
                'university' => 'Universitas Indonesia',
                'expertise' => 'Law',
                'languages' => 'Indonesian, English',
                'publication_count' => 30,
                'hourly_rate' => 220000,
                'verification_status' => 'approved',
                'bio' => 'Professor of international and constitutional law.'
            ],

            [
                'academic_title' => 'Doctor',
                'university' => 'Harvard University',
                'expertise' => 'Economics',
                'languages' => 'English',
                'publication_count' => 15,
                'hourly_rate' => 180000,
                'verification_status' => 'pending',
                'bio' => 'Researcher in macroeconomics and global markets.'
            ],

            [
                'academic_title' => 'Professor',
                'university' => 'University of Tokyo',
                'expertise' => 'Engineering',
                'languages' => 'Japanese, English',
                'publication_count' => 25,
                'hourly_rate' => 240000,
                'verification_status' => 'approved',
                'bio' => 'Engineering professor with expertise in robotics.'
            ],

            [
                'academic_title' => 'Doctor',
                'university' => 'Seoul National University',
                'expertise' => 'Information Systems',
                'languages' => 'Korean, English',
                'publication_count' => 11,
                'hourly_rate' => 160000,
                'verification_status' => 'pending',
                'bio' => 'Information systems and digital transformation researcher.'
            ],

            [
                'academic_title' => 'Professor',
                'university' => 'University of Barcelona',
                'expertise' => 'Social Science',
                'languages' => 'Spanish, English',
                'publication_count' => 22,
                'hourly_rate' => 210000,
                'verification_status' => 'rejected',
                'bio' => 'Social science researcher focusing on education policy.'
            ]

        ];

        $translators = User::where(
            'role',
            'translator'
        )->get();

        foreach ($translators as $index => $translator) {

            TranslatorProfile::create([

                'user_id' => $translator->id,

                'academic_title' =>
                    $profiles[$index]['academic_title'],

                'university' =>
                    $profiles[$index]['university'],

                'expertise' =>
                    $profiles[$index]['expertise'],

                'languages' =>
                    $profiles[$index]['languages'],

                'publication_count' =>
                    $profiles[$index]['publication_count'],

                'hourly_rate' =>
                    $profiles[$index]['hourly_rate'],

                'verification_status' =>
                    $profiles[$index]['verification_status'],

                'bio' =>
                    $profiles[$index]['bio']
            ]);
        }
    }
}