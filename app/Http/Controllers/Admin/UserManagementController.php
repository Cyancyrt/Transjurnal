<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query()
            ->where('role', 'user')
            ->withCount('orders')
            ->withSum('orders', 'price');

        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($query) use ($search) {

                $query->where(
                    'name',
                    'like',
                    "%{$search}%"
                )

                ->orWhere(
                    'email',
                    'like',
                    "%{$search}%"
                );
            });
        }

        $users = $query
            ->latest()
            ->paginate(10);

        $users->appends(
            $request->query()
        );

        $stats = [

            'total' => User::where(
                'role',
                'user'
            )->count(),

            'orders' => Order::count(),

            'completed_orders' => Order::where(
                'status',
                'completed'
            )->count(),

            'total_spending' => Order::sum(
                'price'
            )

        ];

        return view(
            'admin.users.index',
            compact(
                'users',
                'stats'
            )
        );
    }

    public function show(User $user)
    {
        abort_if(
            $user->role !== 'user',
            404
        );

        $user->load([
            'orders'
        ]);

        $totrepoalSpent = $user
            ->orders()
            ->sum('price');

        $completedOrders = $user
            ->orders()
            ->where(
                'status',
                'completed'
            )
            ->count();

        $cancelledOrders = $user
            ->orders()
            ->where(
                'status',
                'cancelled'
            )
            ->count();

        return view(
            'admin.users.show',
            compact(
                'user',
                'totalSpent',
                'completedOrders',
                'cancelledOrders'
            )
        );
    }
}