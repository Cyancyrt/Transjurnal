@extends('layouts.admin')

@section('page-title', 'Service Detail')

@section('content')

<div class="space-y-6">

    <div
    class="bg-gradient-to-r
    from-blue-600
    to-violet-600
    rounded-3xl
    p-8 text-white">

        <div class="flex justify-between items-start">

            <div>

                <p class="text-blue-100">

                    Service

                </p>

                <h1 class="text-3xl font-bold mt-2">

                    {{ $service->name }}

                </h1>

                <p class="mt-3 text-blue-100 max-w-3xl">

                    {{ $service->description }}

                </p>

            </div>

            <a
            href="{{ route('admin.services.edit', $service) }}"
            class="bg-white/20 hover:bg-white/30
            px-5 py-2 rounded-xl transition">

                <i class="bi bi-pencil-square mr-2"></i>

                Edit

            </a>

        </div>

    </div>

    <div class="grid md:grid-cols-3 gap-4">

        <div
        class="bg-white border border-slate-200
        rounded-2xl p-5">

            <p class="text-xs uppercase text-slate-500">

                Base Price

            </p>

            <h2 class="text-3xl font-bold text-green-600 mt-2">

                Rp {{ number_format($service->base_price) }}

            </h2>

        </div>

        <div
        class="bg-white border border-slate-200
        rounded-2xl p-5">

            <p class="text-xs uppercase text-slate-500">

                Total Orders

            </p>

            <h2 class="text-3xl font-bold text-blue-600 mt-2">

                {{ $totalOrders }}

            </h2>

        </div>

        <div
        class="bg-white border border-slate-200
        rounded-2xl p-5">

            <p class="text-xs uppercase text-slate-500">

                Revenue

            </p>

            <h2 class="text-3xl font-bold text-purple-600 mt-2">

                Rp {{ number_format($totalRevenue) }}

            </h2>

        </div>

    </div>

    <div class="grid md:grid-cols-2 gap-4">

        <div
        class="bg-white border border-slate-200
        rounded-2xl p-5">

            <p class="text-xs uppercase text-slate-500">

                Open Orders

            </p>

            <h2 class="text-3xl font-bold text-orange-600 mt-2">

                {{ $openOrders }}

            </h2>

        </div>

        <div
        class="bg-white border border-slate-200
        rounded-2xl p-5">

            <p class="text-xs uppercase text-slate-500">

                Completed Orders

            </p>

            <h2 class="text-3xl font-bold text-green-600 mt-2">

                {{ $completedOrders }}

            </h2>

        </div>

    </div>

    <div
    class="bg-white border border-slate-200
    rounded-2xl overflow-hidden">

        <div
        class="px-6 py-4 border-b border-slate-200">

            <h3 class="font-semibold text-slate-800">

                Recent Orders Using This Service

            </h3>

        </div>

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead>

                    <tr class="bg-slate-50">

                        <th class="px-5 py-4 text-left text-xs uppercase text-slate-500">

                            Order

                        </th>

                        <th class="px-5 py-4 text-left text-xs uppercase text-slate-500">

                            Client

                        </th>

                        <th class="px-5 py-4 text-left text-xs uppercase text-slate-500">

                            Field

                        </th>

                        <th class="px-5 py-4 text-left text-xs uppercase text-slate-500">

                            Status

                        </th>

                        <th class="px-5 py-4 text-left text-xs uppercase text-slate-500">

                            Price

                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($service->orders as $order)

                    <tr class="border-t">

                        <td class="px-5 py-4">

                            <div>

                                <p class="font-medium">

                                    {{ $order->title }}

                                </p>

                                <p class="text-xs text-slate-500">

                                    #{{ $order->id }}

                                </p>

                            </div>

                        </td>

                        <td class="px-5 py-4">

                            {{ $order->user?->name }}

                        </td>

                        <td class="px-5 py-4">

                            {{ $order->field }}

                        </td>

                        <td class="px-5 py-4">

                            @php

                                $badge = match($order->status)
                                {
                                    'open'
                                        => 'bg-orange-100 text-orange-700',

                                    'in_progress'
                                        => 'bg-blue-100 text-blue-700',

                                    'revision'
                                        => 'bg-yellow-100 text-yellow-700',

                                    'completed'
                                        => 'bg-green-100 text-green-700',

                                    'cancelled'
                                        => 'bg-red-100 text-red-700',

                                    default
                                        => 'bg-slate-100 text-slate-700'
                                };

                            @endphp

                            <span
                            class="{{ $badge }}
                            px-3 py-1 rounded-full text-xs">

                                {{ ucfirst(str_replace('_', ' ', $order->status)) }}

                            </span>

                        </td>

                        <td class="px-5 py-4 font-medium text-green-600">

                            Rp {{ number_format($order->price) }}

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td
                        colspan="5"
                        class="text-center py-12 text-slate-500">

                            No orders found.

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection