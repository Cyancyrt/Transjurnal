@extends('layouts.admin')

@section('page-title', 'Reports')

@section('content')

<div class="space-y-6">

    <div
    class="bg-gradient-to-r
    from-indigo-600
    via-blue-600
    to-cyan-600
    rounded-3xl
    p-8 text-white">

        <h1 class="text-3xl font-bold">

            Marketplace Analytics

        </h1>

        <p class="mt-2 text-blue-100">

            Monitor revenue, customer behavior, scholar activity and platform growth.

        </p>

    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">

        <div class="bg-white border border-slate-200 rounded-2xl p-5">

            <p class="text-xs uppercase text-slate-500">

                Total Revenue

            </p>

            <h2 class="text-3xl font-bold text-green-600 mt-2">

                Rp {{ number_format($totalRevenue) }}

            </h2>

        </div>

        <div class="bg-white border border-slate-200 rounded-2xl p-5">

            <p class="text-xs uppercase text-slate-500">

                Orders

            </p>

            <h2 class="text-3xl font-bold text-blue-600 mt-2">

                {{ $totalOrders }}

            </h2>

        </div>

        <div class="bg-white border border-slate-200 rounded-2xl p-5">

            <p class="text-xs uppercase text-slate-500">

                Users

            </p>

            <h2 class="text-3xl font-bold text-violet-600 mt-2">

                {{ $totalUsers }}

            </h2>

        </div>

        <div class="bg-white border border-slate-200 rounded-2xl p-5">

            <p class="text-xs uppercase text-slate-500">

                Scholars

            </p>

            <h2 class="text-3xl font-bold text-orange-600 mt-2">

                {{ $totalScholars }}

            </h2>

        </div>

    </div>

    <div class="grid md:grid-cols-3 gap-4">

        <div class="bg-white border border-slate-200 rounded-2xl p-5">

            <p class="text-xs uppercase text-slate-500">

                Users With Orders

            </p>

            <h3 class="text-3xl font-bold mt-2">

                {{ $usersWithOrders }}

            </h3>

        </div>

        <div class="bg-white border border-slate-200 rounded-2xl p-5">

            <p class="text-xs uppercase text-slate-500">

                Users Without Orders

            </p>

            <h3 class="text-3xl font-bold mt-2">

                {{ $usersWithoutOrders }}

            </h3>

        </div>

        <div class="bg-white border border-slate-200 rounded-2xl p-5">

            <p class="text-xs uppercase text-slate-500">

                Average Orders Per User

            </p>

            <h3 class="text-3xl font-bold mt-2">

                {{ $averageOrdersPerUser }}

            </h3>

        </div>

    </div>

    <div class="grid md:grid-cols-3 gap-4">

        <div class="bg-white border border-slate-200 rounded-2xl p-5">

            <p class="text-xs uppercase text-slate-500">

                Average Order Value

            </p>

            <h3 class="text-2xl font-bold text-green-600 mt-2">

                Rp {{ number_format($averageOrderValue) }}

            </h3>

        </div>

        <div class="bg-white border border-slate-200 rounded-2xl p-5">

            <p class="text-xs uppercase text-slate-500">

                Highest Order

            </p>

            <h3 class="text-2xl font-bold text-blue-600 mt-2">

                Rp {{ number_format($highestOrder) }}

            </h3>

        </div>

        <div class="bg-white border border-slate-200 rounded-2xl p-5">

            <p class="text-xs uppercase text-slate-500">

                Lowest Order

            </p>

            <h3 class="text-2xl font-bold text-orange-600 mt-2">

                Rp {{ number_format($lowestOrder) }}

            </h3>

        </div>

    </div>

    <div class="grid lg:grid-cols-2 gap-6">

        <div class="bg-white border border-slate-200 rounded-2xl p-6">

            <h3 class="font-semibold mb-6">

                Revenue By Service

            </h3>

            <div class="space-y-5">

                @foreach($serviceReports as $service)

                @php
                    $percentage =
                        $maxRevenue > 0
                        ? (($service->orders_sum_price ?? 0) / $maxRevenue) * 100
                        : 0;
                @endphp

                <div>

                    <div class="flex justify-between mb-2">

                        <span class="font-medium">

                            {{ $service->name }}

                        </span>

                        <span class="text-green-600">

                            Rp {{ number_format($service->orders_sum_price ?? 0) }}

                        </span>

                    </div>

                    <div class="h-3 bg-slate-100 rounded-full overflow-hidden">

                        <div
                        class="h-full rounded-full bg-gradient-to-r from-blue-500 to-violet-500"
                        style="width: {{ $percentage }}%">

                        </div>

                    </div>

                </div>

                @endforeach

            </div>

        </div>

        <div class="bg-white border border-slate-200 rounded-2xl p-6">

            <h3 class="font-semibold mb-6">

                Order Status Overview

            </h3>

            <div class="grid grid-cols-2 gap-4">

                <div class="bg-orange-50 rounded-2xl p-5 text-center">
                    <h3 class="text-3xl font-bold text-orange-600">{{ $openOrders }}</h3>
                    <p class="mt-2 text-sm">Open</p>
                </div>

                <div class="bg-blue-50 rounded-2xl p-5 text-center">
                    <h3 class="text-3xl font-bold text-blue-600">{{ $inProgressOrders }}</h3>
                    <p class="mt-2 text-sm">In Progress</p>
                </div>

                <div class="bg-yellow-50 rounded-2xl p-5 text-center">
                    <h3 class="text-3xl font-bold text-yellow-600">{{ $revisionOrders }}</h3>
                    <p class="mt-2 text-sm">Revision</p>
                </div>

                <div class="bg-green-50 rounded-2xl p-5 text-center">
                    <h3 class="text-3xl font-bold text-green-600">{{ $completedOrders }}</h3>
                    <p class="mt-2 text-sm">Completed</p>
                </div>

                <div class="bg-red-50 rounded-2xl p-5 text-center col-span-2">
                    <h3 class="text-3xl font-bold text-red-600">{{ $cancelledOrders }}</h3>
                    <p class="mt-2 text-sm">Cancelled</p>
                </div>

            </div>

        </div>

    </div>

    <div class="grid md:grid-cols-2 gap-6">

        <div class="bg-white border border-green-200 rounded-2xl p-5">

            <p class="text-green-700 text-sm">

                Verified Scholars

            </p>

            <h3 class="text-4xl font-bold text-green-600 mt-2">

                {{ $verifiedScholars }}

            </h3>

        </div>

        <div class="bg-white border border-yellow-200 rounded-2xl p-5">

            <p class="text-yellow-700 text-sm">

                Pending Verification

            </p>

            <h3 class="text-4xl font-bold text-yellow-600 mt-2">

                {{ $pendingVerification }}

            </h3>

        </div>

    </div>

    <div class="grid lg:grid-cols-2 gap-6">

        <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden">

            <div class="px-6 py-4 border-b">

                <h3 class="font-semibold">

                    Top Scholars

                </h3>

            </div>

            <div class="divide-y">

                @foreach($topScholars as $scholar)

                <div class="p-4 flex justify-between">

                    <div>

                        <p class="font-medium">

                            {{ $scholar->user->name }}

                        </p>

                        <p class="text-sm text-slate-500">

                            {{ $scholar->expertise }}

                        </p>

                    </div>

                    <div class="text-right">

                        <p class="font-bold">

                            {{ $scholar->completed_orders }}

                        </p>

                        <p class="text-xs text-slate-500">

                            Completed

                        </p>

                    </div>

                </div>

                @endforeach

            </div>

        </div>

        <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden">

            <div class="px-6 py-4 border-b">

                <h3 class="font-semibold">

                    Top Customers

                </h3>

            </div>

            <div class="divide-y">

                @foreach($topCustomers as $customer)

                <div class="p-4 flex justify-between">

                    <div>

                        <p class="font-medium">

                            {{ $customer->name }}

                        </p>

                        <p class="text-sm text-slate-500">

                            {{ $customer->email }}

                        </p>

                    </div>

                    <div class="text-right">

                        <p class="font-bold">

                            {{ $customer->orders_count }}

                        </p>

                        <p class="text-xs text-slate-500">

                            Orders

                        </p>

                    </div>

                </div>

                @endforeach

            </div>

        </div>

    </div>

    <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden">

        <div class="px-6 py-4 border-b">

            <h3 class="font-semibold">

                Recent Orders

            </h3>

        </div>

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead>

                    <tr class="bg-slate-50">

                        <th class="px-5 py-4 text-left text-xs uppercase text-slate-500">Order</th>
                        <th class="px-5 py-4 text-left text-xs uppercase text-slate-500">Customer</th>
                        <th class="px-5 py-4 text-left text-xs uppercase text-slate-500">Service</th>
                        <th class="px-5 py-4 text-left text-xs uppercase text-slate-500">Price</th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($recentOrders as $order)

                    <tr class="border-t">

                        <td class="px-5 py-4">{{ $order->title }}</td>

                        <td class="px-5 py-4">{{ $order->user?->name }}</td>

                        <td class="px-5 py-4">{{ $order->service?->name }}</td>

                        <td class="px-5 py-4 text-green-600 font-medium">
                            Rp {{ number_format($order->price) }}
                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection