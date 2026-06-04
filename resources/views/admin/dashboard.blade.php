@extends('layouts.admin')

@section('page-title', 'Dashboard')

@section('content')

<div class="space-y-6">

    <div
    class="relative overflow-hidden
    bg-gradient-to-r
    from-blue-600
    via-indigo-600
    to-violet-700
    rounded-3xl
    text-white
    p-8 shadow-xl">

        <div class="relative z-10">

            <h1 class="text-3xl font-bold">

                Welcome Back Admin 👋

            </h1>

            <p class="mt-2 text-blue-100">

                Monitor marketplace activity, scholars and transactions.

            </p>

            <div class="mt-6 flex gap-8">

                <div>

                    <p class="text-blue-200 text-sm">

                        Total Revenue

                    </p>

                    <p class="text-3xl font-bold">

                        Rp {{ number_format($totalRevenue) }}

                    </p>

                </div>

                <div>

                    <p class="text-blue-200 text-sm">

                        Completed Orders

                    </p>

                    <p class="text-3xl font-bold">

                        {{ $completedOrders }}

                    </p>

                </div>

            </div>

        </div>

        <div
        class="absolute -right-10 -top-10
        w-64 h-64
        rounded-full
        bg-white/10">

        </div>

    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5">

        <x-admin.stat-card
            title="Users"
            :value="$totalUsers"
            icon="bi bi-people"
            color="bg-blue-500"/>

        <x-admin.stat-card
            title="Scholars"
            :value="$totalTranslators"
            icon="bi bi-mortarboard"
            color="bg-violet-500"/>

        <x-admin.stat-card
            title="Orders"
            :value="$totalOrders"
            icon="bi bi-journal-text"
            color="bg-green-500"/>

        <x-admin.stat-card
            title="Open Market"
            :value="$openOrders"
            icon="bi bi-shop"
            color="bg-orange-500"/>

    </div>

    <div class="grid lg:grid-cols-2 gap-6">

        <div
        class="bg-white
        border border-slate-200
        rounded-3xl p-6">

            <div class="flex justify-between">

                <h3 class="font-semibold">

                    Latest Orders

                </h3>

                <a
                href="{{ route('admin.orders.index') }}"
                class="text-sm text-blue-600">

                    View All

                </a>

            </div>

            <div class="mt-5 space-y-4">

                @foreach($latestOrders as $order)

                <div
                class="flex justify-between items-center
                border-b pb-3">

                    <div>

                        <p class="font-medium">

                            {{ $order->title }}

                        </p>

                        <p class="text-xs text-slate-500">

                            {{ $order->user?->name }}

                        </p>

                    </div>

                    <span
                    class="text-sm font-medium text-green-600">

                        Rp {{ number_format($order->price) }}

                    </span>

                </div>

                @endforeach

            </div>

        </div>

        <div
        class="bg-white
        border border-slate-200
        rounded-3xl p-6">

            <div class="flex justify-between">

                <h3 class="font-semibold">

                    Top Scholars

                </h3>

                <a
                href="{{ route('admin.scholars.index') }}"
                class="text-sm text-blue-600">

                    View All

                </a>

            </div>

            <div class="mt-5 space-y-4">

                @foreach($topScholars as $scholar)

                <div
                class="flex justify-between items-center
                border-b pb-3">

                    <div>

                        <p class="font-medium">

                            {{ $scholar->user->name }}

                        </p>

                        <p class="text-xs text-slate-500">

                            {{ $scholar->expertise }}

                        </p>

                    </div>

                    <span
                    class="text-sm font-medium">

                        {{ $scholar->publication_count }}

                        Publications

                    </span>

                </div>

                @endforeach

            </div>

        </div>

    </div>

</div>

@endsection