<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Service;
use App\Models\TranslatorProfile;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $featuredScholars = TranslatorProfile::with('user')
            ->approved()
            ->orderByDesc('publication_count')
            ->take(10)
            ->get();

        $services = Service::latest()
            ->take(6)
            ->get();

        $recentOrders = Order::with([
                'translator',
                'service'
            ])
            ->where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        $completedTranslations = Order::with([
                'translator',
                'service'
            ])
            ->where('user_id', $user->id)
            ->where('status', 'completed')
            ->latest()
            ->take(6)
            ->get();

        return view(
            'user.dashboard',
            compact(
                'featuredScholars',
                'services',
                'recentOrders',
                'completedTranslations'
            )
        );
    }
}