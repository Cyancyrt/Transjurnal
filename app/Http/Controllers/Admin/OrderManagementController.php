<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderManagementController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with([
            'user',
            'translator',
            'service',
            'requests'
        ]);

        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($query) use ($search) {

                $query->where(
                    'title',
                    'like',
                    "%{$search}%"
                )

                ->orWhere(
                    'field',
                    'like',
                    "%{$search}%"
                )

                ->orWhereHas(
                    'user',
                    function ($user) use ($search) {

                        $user->where(
                            'name',
                            'like',
                            "%{$search}%"
                        );
                    }
                );
            });
        }

        if (
            $request->filled('status')
            &&
            $request->status !== 'all'
        ) {
            $query->where(
                'status',
                $request->status
            );
        }

        $orders = $query
            ->latest()
            ->paginate(10);

        $orders->appends(
            $request->query()
        );

        $stats = [
            'total' => Order::count(),

            'open' => Order::where(
                'status',
                'open'
            )->count(),

            'in_progress' => Order::where(
                'status',
                'in_progress'
            )->count(),

            'completed' => Order::where(
                'status',
                'completed'
            )->count(),
        ];

        return view(
            'admin.orders.index',
            compact(
                'orders',
                'stats'
            )
        );
    }

    public function show(Order $order)
    {
        $order->load([
            'user',
            'translator',
            'service',
            'requests.translator'
        ]);

        return view(
            'admin.orders.show',
            compact('order')
        );
    }
}