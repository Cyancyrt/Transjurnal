<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\TranslatorProfile;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalRevenue = Order::sum(
            'price'
        );

        $completedOrders = Order::where(
            'status',
            'completed'
        )->count();

        $openOrders = Order::where(
            'status',
            'open'
        )->count();

        $latestOrders = Order::with([
                'user'
            ])
            ->latest()
            ->take(5)
            ->get();

        $topScholars = TranslatorProfile::with(
                'user'
            )
            ->orderByDesc(
                'publication_count'
            )
            ->take(5)
            ->get();

        return view(
            'admin.dashboard',
            [

                'totalUsers' => User::where(
                    'role',
                    'user'
                )->count(),

                'totalTranslators' => User::where(
                    'role',
                    'translator'
                )->count(),

                'totalOrders' => Order::count(),

                'openOrders' => $openOrders,

                'completedOrders' => $completedOrders,

                'totalRevenue' => $totalRevenue,

                'latestOrders' => $latestOrders,

                'topScholars' => $topScholars

            ]
        );
    }
}