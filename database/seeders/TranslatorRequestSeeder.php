<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\User;
use App\Models\TranslatorRequest;
use Illuminate\Database\Seeder;

class TranslatorRequestSeeder extends Seeder
{
    public function run(): void
    {
        $translators = User::where(
            'role',
            'translator'
        )->pluck('id');

        $orders = Order::all();

        foreach ($orders as $order) {

            /*
            |--------------------------------------------------------------------------
            | Random request count
            |--------------------------------------------------------------------------
            */

            $requestCount = rand(0, 5);

            if ($requestCount === 0) {
                continue;
            }

            $selectedTranslators = $translators
                ->shuffle()
                ->take($requestCount);

            foreach ($selectedTranslators as $translatorId) {

                TranslatorRequest::create([

                    'order_id' => $order->id,

                    'translator_id' => $translatorId,

                    'status' => collect([
                        'pending',
                        'pending',
                        'pending',
                        'accepted',
                        'rejected'
                    ])->random()

                ]);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Assign accepted translator
        |--------------------------------------------------------------------------
        */

        $acceptedRequests = TranslatorRequest::where(
            'status',
            'accepted'
        )->get();

        foreach ($acceptedRequests as $request) {

            $request->order->update([

                'translator_id' =>
                    $request->translator_id,

                'status' =>
                    collect([
                        'in_progress',
                        'revision',
                        'completed'
                    ])->random()

            ]);
        }
    }
}