<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceManagementController extends Controller
{
    public function index(Request $request)
    {
        $query = Service::query()
            ->withCount('orders')
            ->withSum(
                'orders',
                'price'
            );

        if ($request->filled('search')) {

            $query->where(
                'name',
                'like',
                '%' . $request->search . '%'
            );
        }

        $services = $query
            ->latest()
            ->paginate(10);

        $services->appends(
            $request->query()
        );

        foreach ($services as $service) {

            $service->short_description =
                str($service->description)
                    ->limit(80);
        }

        $stats = [

            'total' => Service::count(),

            'orders' => Order::count(),

            'revenue' => Order::sum(
                'price'
            ),

            'average_price' => Service::avg(
                'base_price'
            )

        ];

        return view(
            'admin.services.index',
            compact(
                'services',
                'stats'
            )
        );
    }

    public function show(Service $service)
    {
        $service->load([
            'orders.user'
        ]);

        $totalOrders = $service
            ->orders()
            ->count();

        $totalRevenue = $service
            ->orders()
            ->sum('price');

        $completedOrders = $service
            ->orders()
            ->where(
                'status',
                'completed'
            )
            ->count();

        $openOrders = $service
            ->orders()
            ->where(
                'status',
                'open'
            )
            ->count();

        return view(
            'admin.services.show',
            compact(
                'service',
                'totalOrders',
                'totalRevenue',
                'completedOrders',
                'openOrders'
            )
        );
    }

    public function create()
    {
        return view(
            'admin.services.create'
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([

            'name' => [
                'required',
                'string',
                'max:255'
            ],

            'description' => [
                'required',
                'string'
            ],

            'base_price' => [
                'required',
                'numeric',
                'min:0'
            ]

        ]);

        Service::create(
            $validated
        );

        return redirect()
            ->route(
                'admin.services.index'
            )
            ->with(
                'success',
                'Service created successfully.'
            );
    }

    public function edit(Service $service)
    {
        return view(
            'admin.services.edit',
            compact('service')
        );
    }

    public function update(
        Request $request,
        Service $service
    )
    {
        $validated = $request->validate([

            'name' => [
                'required',
                'string',
                'max:255'
            ],

            'description' => [
                'required',
                'string'
            ],

            'base_price' => [
                'required',
                'numeric',
                'min:0'
            ]

        ]);

        $service->update(
            $validated
        );

        return redirect()
            ->route(
                'admin.services.index'
            )
            ->with(
                'success',
                'Service updated successfully.'
            );
    }

    public function destroy(Service $service)
    {
        if (
            $service->orders()->exists()
        ) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'This service cannot be deleted because it is already used by orders.'
                );
        }

        $service->delete();

        return redirect()
            ->route(
                'admin.services.index'
            )
            ->with(
                'success',
                'Service deleted successfully.'
            );
    }
}