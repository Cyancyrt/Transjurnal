@extends('layouts.admin')

@section('page-title', 'User Detail')

@section('content')

<div class="space-y-6">

    <div class="bg-white border border-slate-200 rounded-2xl p-6">

        <div class="flex items-center gap-5">

            <div
            class="w-20 h-20 rounded-full
            bg-blue-100 text-blue-700
            flex items-center justify-center
            text-2xl font-bold">

                {{ strtoupper(substr($user->name,0,1)) }}

            </div>

            <div>

                <h1 class="text-2xl font-bold text-slate-800">

                    {{ $user->name }}

                </h1>

                <p class="text-slate-500">

                    {{ $user->email }}

                </p>

                <p class="text-sm text-slate-400 mt-1">

                    Member since
                    {{ $user->created_at->format('d F Y') }}

                </p>

            </div>

        </div>

    </div>

    <div class="grid md:grid-cols-4 gap-4">

        <div class="bg-white border border-slate-200 rounded-2xl p-5">

            <p class="text-xs uppercase text-slate-500">

                Total Orders

            </p>

            <h2 class="text-3xl font-bold mt-2">

                {{ $user->orders->count() }}

            </h2>

        </div>

        <div class="bg-white border border-slate-200 rounded-2xl p-5">

            <p class="text-xs uppercase text-slate-500">

                Completed

            </p>

            <h2 class="text-3xl font-bold text-green-600 mt-2">

                {{ $completedOrders }}

            </h2>

        </div>

        <div class="bg-white border border-slate-200 rounded-2xl p-5">

            <p class="text-xs uppercase text-slate-500">

                Cancelled

            </p>

            <h2 class="text-3xl font-bold text-red-600 mt-2">

                {{ $cancelledOrders }}

            </h2>

        </div>

        <div class="bg-white border border-slate-200 rounded-2xl p-5">

            <p class="text-xs uppercase text-slate-500">

                Total Spending

            </p>

            <h2 class="text-xl font-bold text-purple-600 mt-2">

                Rp {{ number_format($totalSpent) }}

            </h2>

        </div>

    </div>

    <div
    class="bg-white
    border border-slate-200
    rounded-2xl
    overflow-hidden">

        <div class="px-6 py-4 border-b">

            <h3 class="font-semibold text-slate-800">

                Order History

            </h3>

        </div>

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead>

                    <tr class="bg-slate-50 border-b">

                        <th class="px-5 py-4 text-left text-xs uppercase text-slate-500">
                            ID
                        </th>

                        <th class="px-5 py-4 text-left text-xs uppercase text-slate-500">
                            Title
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

                        <th class="px-5 py-4 text-left text-xs uppercase text-slate-500">
                            Created
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($user->orders as $order)

                    <tr class="border-b">

                        <td class="px-5 py-4">

                            #{{ $order->id }}

                        </td>

                        <td class="px-5 py-4 font-medium">

                            {{ $order->title }}

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

                                {{ ucfirst(str_replace('_',' ',$order->status)) }}

                            </span>

                        </td>

                        <td class="px-5 py-4 font-medium text-green-600">

                            Rp {{ number_format($order->price) }}

                        </td>

                        <td class="px-5 py-4 text-slate-500">

                            {{ $order->created_at->format('d M Y') }}

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td
                        colspan="6"
                        class="text-center py-10 text-slate-500">

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