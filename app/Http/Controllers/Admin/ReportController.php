<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Service;
use App\Models\TranslatorProfile;
use App\Models\User;

class ReportController extends Controller
{
    public function index()
    {
        $totalRevenue = Order::sum('price');

        $totalOrders = Order::count();

        $totalUsers = User::where(
            'role',
            'user'
        )->count();

        $totalScholars = User::where(
            'role',
            'translator'
        )->count();

        $completedOrders = Order::where(
            'status',
            'completed'
        )->count();

        $openOrders = Order::where(
            'status',
            'open'
        )->count();

        $inProgressOrders = Order::where(
            'status',
            'in_progress'
        )->count();

        $revisionOrders = Order::where(
            'status',
            'revision'
        )->count();

        $cancelledOrders = Order::where(
            'status',
            'cancelled'
        )->count();

        /*
        |--------------------------------------------------------------------------
        | Customer Analytics
        |--------------------------------------------------------------------------
        */

        $usersWithOrders = User::where(
                'role',
                'user'
            )
            ->has('orders')
            ->count();

        $usersWithoutOrders =
            $totalUsers - $usersWithOrders;

        $averageOrdersPerUser =
            $usersWithOrders > 0
            ? round(
                $totalOrders / $usersWithOrders,
                1
            )
            : 0;

        $topCustomers = User::where(
                'role',
                'user'
            )
            ->withCount('orders')
            ->orderByDesc(
                'orders_count'
            )
            ->take(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Scholar Analytics
        |--------------------------------------------------------------------------
        */

        $verifiedScholars =
            TranslatorProfile::where(
                'verification_status',
                'approved'
            )->count();

        $pendingVerification =
            TranslatorProfile::where(
                'verification_status',
                'pending'
            )->count();

        $topScholars = TranslatorProfile::with(
                'user'
            )
            ->get()
            ->map(function ($profile) {

                $profile->completed_orders =
                    $profile->user
                        ->assignedOrders()
                        ->where(
                            'status',
                            'completed'
                        )
                        ->count();

                $profile->revenue =
                    $profile->user
                        ->assignedOrders()
                        ->where(
                            'status',
                            'completed'
                        )
                        ->sum('price');

                return $profile;

            })
            ->sortByDesc(
                'completed_orders'
            )
            ->take(10);

        /*
        |--------------------------------------------------------------------------
        | Service Analytics
        |--------------------------------------------------------------------------
        */

        $serviceReports = Service::query()
            ->withCount('orders')
            ->withSum(
                'orders',
                'price'
            )
            ->orderByDesc(
                'orders_count'
            )
            ->get();

        $mostPopularService =
            $serviceReports->first();

        $maxRevenue =
            $serviceReports->max(
                'orders_sum_price'
            );

        /*
        |--------------------------------------------------------------------------
        | Order Analytics
        |--------------------------------------------------------------------------
        */

        $statusReports = [

            'open' => $openOrders,

            'in_progress' =>
                $inProgressOrders,

            'revision' =>
                $revisionOrders,

            'completed' =>
                $completedOrders,

            'cancelled' =>
                $cancelledOrders

        ];

        /*
        |--------------------------------------------------------------------------
        | Financial Analytics
        |--------------------------------------------------------------------------
        */

        $averageOrderValue =
            $totalOrders > 0
            ? round(
                $totalRevenue / $totalOrders
            )
            : 0;

        $highestOrder =
            Order::max('price');

        $lowestOrder =
            Order::min('price');

        /*
        |--------------------------------------------------------------------------
        | Recent Activity
        |--------------------------------------------------------------------------
        */

        $recentOrders = Order::with([
                'user',
                'service'
            ])
            ->latest()
            ->take(10)
            ->get();

        return view(
            'admin.reports.index',
            compact(

                'totalRevenue',
                'totalOrders',
                'totalUsers',
                'totalScholars',

                'completedOrders',
                'openOrders',
                'inProgressOrders',
                'revisionOrders',
                'cancelledOrders',

                'usersWithOrders',
                'usersWithoutOrders',
                'averageOrdersPerUser',
                'topCustomers',

                'verifiedScholars',
                'pendingVerification',
                'topScholars',

                'serviceReports',
                'mostPopularService',
                'maxRevenue',

                'statusReports',

                'averageOrderValue',
                'highestOrder',
                'lowestOrder',

                'recentOrders'
            )
        );
    }
}