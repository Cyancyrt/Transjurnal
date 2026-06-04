@extends('layouts.admin')

@section('page-title', 'Orders')

@section('content')

<div class="space-y-6">

    {{-- Header --}}

    <div class="flex items-center justify-between">

        <div>

            <h1 class="text-2xl font-bold text-slate-800">
                Orders Management
            </h1>

            <p class="text-sm text-slate-500 mt-1">
                Monitor all translation transactions across the platform.
            </p>

        </div>

    </div>

    {{-- Statistics --}}

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-5 gap-4">

        <div class="bg-white rounded-2xl border border-slate-200 p-5">

            <p class="text-xs text-slate-500 uppercase">
                Total Orders
            </p>

            <h2 class="text-3xl font-bold mt-2">
                {{ $stats['total'] }}
            </h2>

        </div>

        <div class="bg-white rounded-2xl border border-slate-200 p-5">

            <p class="text-xs text-slate-500 uppercase">
                Open
            </p>

            <h2 class="text-3xl font-bold text-orange-500 mt-2">
                {{ $stats['open'] }}
            </h2>

        </div>

        <div class="bg-white rounded-2xl border border-slate-200 p-5">

            <p class="text-xs text-slate-500 uppercase">
                In Progress
            </p>

            <h2 class="text-3xl font-bold text-blue-500 mt-2">
                {{ $stats['in_progress'] }}
            </h2>

        </div>

        <div class="bg-white rounded-2xl border border-slate-200 p-5">

            <p class="text-xs text-slate-500 uppercase">
                Completed
            </p>

            <h2 class="text-3xl font-bold text-green-500 mt-2">
                {{ $stats['completed'] }}
            </h2>

        </div>

        <div class="bg-white rounded-2xl border border-slate-200 p-5">

            <p class="text-xs text-slate-500 uppercase">
                Revenue
            </p>

            <h2 class="text-3xl font-bold text-violet-600 mt-2">
                Rp {{ number_format($orders->sum('price')) }}
            </h2>

        </div>

    </div>

    {{-- Filters --}}

    <div class="bg-white rounded-2xl border border-slate-200 p-4">

        <form
            action="{{ route('admin.orders.index') }}"
            method="GET"
            class="flex flex-col lg:flex-row gap-3">

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search title, field, client..."
                class="flex-1 border border-slate-300 rounded-xl px-4 py-2.5">

            <select
                name="status"
                class="border border-slate-300 rounded-xl px-4 py-2.5">

                <option value="all">
                    All Status
                </option>

                <option value="open">
                    Open
                </option>

                <option value="in_progress">
                    In Progress
                </option>

                <option value="revision">
                    Revision
                </option>

                <option value="completed">
                    Completed
                </option>

                <option value="cancelled">
                    Cancelled
                </option>

            </select>

            <button
                class="bg-blue-600 hover:bg-blue-700 text-white px-5 rounded-xl">

                Search

            </button>

        </form>

    </div>

    {{-- Table --}}

    <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead>

                    <tr class="bg-slate-50 border-b">

                        <th class="px-5 py-4 text-left text-xs font-semibold text-slate-500 uppercase">
                            ID
                        </th>

                        <th class="px-5 py-4 text-left text-xs font-semibold text-slate-500 uppercase">
                            Journal
                        </th>

                        <th class="px-5 py-4 text-left text-xs font-semibold text-slate-500 uppercase">
                            Field
                        </th>

                        <th class="px-5 py-4 text-left text-xs font-semibold text-slate-500 uppercase">
                            Client
                        </th>

                        <th class="px-5 py-4 text-left text-xs font-semibold text-slate-500 uppercase">
                            Scholar
                        </th>

                        <th class="px-5 py-4 text-center text-xs font-semibold text-slate-500 uppercase">
                            Requests
                        </th>

                        <th class="px-5 py-4 text-left text-xs font-semibold text-slate-500 uppercase">
                            Status
                        </th>

                        <th class="px-5 py-4 text-right text-xs font-semibold text-slate-500 uppercase">
                            Price
                        </th>

                        <th class="px-5 py-4 text-center text-xs font-semibold text-slate-500 uppercase">
                            Action
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($orders as $order)

                    <tr class="border-b hover:bg-slate-50">

                        <td class="px-5 py-4 font-medium">
                            #{{ $order->id }}
                        </td>

                        <td class="px-5 py-4">

                            <p class="font-medium text-slate-800">

                                {{ $order->title }}

                            </p>

                            <p class="text-xs text-slate-500 mt-1">

                                {{ $order->source_language }}
                                →
                                {{ $order->target_language }}

                            </p>

                        </td>

                        <td class="px-5 py-4">

                            <span
                            class="px-3 py-1 rounded-full bg-slate-100 text-slate-600 text-xs">

                                {{ $order->field }}

                            </span>

                        </td>

                        <td class="px-5 py-4">

                            {{ $order->user?->name }}

                        </td>

                        <td class="px-5 py-4">

                            @if($order->translator)

                                {{ $order->translator->name }}

                            @else

                                <span class="text-orange-600 font-medium">

                                    Open Market

                                </span>

                            @endif

                        </td>

                        <td class="px-5 py-4 text-center">

                            <span
                            class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-slate-100 text-sm">

                                {{ $order->requests->count() }}

                            </span>

                        </td>

                        <td class="px-5 py-4">

                            <span
                            class="px-3 py-1 rounded-full text-xs font-medium

                            @if($order->status == 'open')
                                bg-orange-100 text-orange-700
                            @elseif($order->status == 'in_progress')
                                bg-blue-100 text-blue-700
                            @elseif($order->status == 'revision')
                                bg-yellow-100 text-yellow-700
                            @elseif($order->status == 'completed')
                                bg-green-100 text-green-700
                            @else
                                bg-red-100 text-red-700
                            @endif">

                                {{ str_replace('_',' ', ucfirst($order->status)) }}

                            </span>

                        </td>

                        <td class="px-5 py-4 text-right font-semibold text-green-600">

                            Rp {{ number_format($order->price) }}

                        </td>

                        <td class="px-5 py-4 text-center">

                            <a
                                href="{{ route('admin.orders.show',$order) }}"
                                class="inline-flex items-center justify-center w-9 h-9 rounded-lg border border-slate-300 hover:bg-slate-100">

                                <i class="bi bi-eye"></i>

                            </a>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td
                            colspan="9"
                            class="text-center py-12 text-slate-500">

                            No orders found.

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

    @if($orders->hasPages())

    <div>

        {{ $orders->links() }}

    </div>

    @endif

</div>

@endsection