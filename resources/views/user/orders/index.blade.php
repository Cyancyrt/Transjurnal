@extends('layouts.admin')

@section('page-title', 'Orders')

@section('content')

{{-- HEADER --}}

<div class="mb-8">

    <div
    class="flex flex-col lg:flex-row
    lg:items-center
    lg:justify-between
    gap-4">

        <div>

            <h1
            class="text-3xl font-bold
            text-slate-800">

                Orders Management

            </h1>

            <p
            class="text-slate-500 mt-2">

                Monitor all translation transactions across the platform.

            </p>

        </div>

    </div>

</div>

{{-- STATS --}}

<div
class="grid
grid-cols-2
xl:grid-cols-5
gap-5
mb-8">

    <div
    class="bg-white rounded-2xl
    shadow-sm
    border border-slate-200
    p-5">

        <p class="text-sm text-slate-500">

            Total Orders

        </p>

        <h2
        class="text-3xl font-bold
        mt-2">

            {{ $stats['total'] }}

        </h2>

    </div>

    <div
    class="bg-white rounded-2xl
    shadow-sm
    border border-slate-200
    p-5">

        <p class="text-sm text-slate-500">

            Open

        </p>

        <h2
        class="text-3xl font-bold
        text-orange-500 mt-2">

            {{ $stats['open'] }}

        </h2>

    </div>

    <div
    class="bg-white rounded-2xl
    shadow-sm
    border border-slate-200
    p-5">

        <p class="text-sm text-slate-500">

            In Progress

        </p>

        <h2
        class="text-3xl font-bold
        text-blue-500 mt-2">

            {{ $stats['in_progress'] }}

        </h2>

    </div>

    <div
    class="bg-white rounded-2xl
    shadow-sm
    border border-slate-200
    p-5">

        <p class="text-sm text-slate-500">

            Completed

        </p>

        <h2
        class="text-3xl font-bold
        text-green-500 mt-2">

            {{ $stats['completed'] }}

        </h2>

    </div>

    <div
    class="bg-white rounded-2xl
    shadow-sm
    border border-slate-200
    p-5">

        <p class="text-sm text-slate-500">

            Revenue

        </p>

        <h2
        class="text-3xl font-bold
        text-violet-600 mt-2">

            Rp {{ number_format($orders->sum('price')) }}

        </h2>

    </div>

</div>

{{-- FILTER --}}

<div
class="bg-white rounded-2xl
shadow-sm border border-slate-200
p-5 mb-6">

    <form
    method="GET"
    action="{{ route('admin.orders.index') }}">

        <div
        class="flex flex-col
        md:flex-row
        gap-3">

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search order title, field, user..."
                class="flex-1
                border border-slate-300
                rounded-xl
                px-4 py-3">

            <select
                name="status"
                class="border border-slate-300
                rounded-xl
                px-4 py-3">

                <option value="all">

                    All Status

                </option>

                <option
                value="open"
                {{ request('status') == 'open' ? 'selected' : '' }}>

                    Open

                </option>

                <option
                value="in_progress"
                {{ request('status') == 'in_progress' ? 'selected' : '' }}>

                    In Progress

                </option>

                <option
                value="revision"
                {{ request('status') == 'revision' ? 'selected' : '' }}>

                    Revision

                </option>

                <option
                value="completed"
                {{ request('status') == 'completed' ? 'selected' : '' }}>

                    Completed

                </option>

                <option
                value="cancelled"
                {{ request('status') == 'cancelled' ? 'selected' : '' }}>

                    Cancelled

                </option>

            </select>

            <button
            class="bg-blue-600
            hover:bg-blue-700
            text-white
            px-5 py-3
            rounded-xl">

                Search

            </button>

        </div>

    </form>

</div>

{{-- TABLE --}}

<div
class="bg-white
rounded-2xl
shadow-sm
border border-slate-200
overflow-hidden">

    <div class="overflow-x-auto">

        <table class="w-full">

            <thead>

                <tr
                class="bg-slate-100
                text-slate-600
                text-sm">

                    <th class="p-4 text-left">

                        ID

                    </th>

                    <th class="p-4 text-left">

                        Title

                    </th>

                    <th class="p-4 text-left">

                        Field

                    </th>

                    <th class="p-4 text-left">

                        Client

                    </th>

                    <th class="p-4 text-left">

                        Scholar

                    </th>

                    <th class="p-4 text-center">

                        Requests

                    </th>

                    <th class="p-4 text-left">

                        Status

                    </th>

                    <th class="p-4 text-right">

                        Price

                    </th>

                    <th class="p-4 text-center">

                        Action

                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($orders as $order)

                <tr
                class="border-t
                hover:bg-slate-50
                transition">

                    <td class="p-4 font-medium">

                        #{{ $order->id }}

                    </td>

                    <td class="p-4">

                        <div>

                            <p
                            class="font-medium
                            text-slate-800">

                                {{ $order->title }}

                            </p>

                            <p
                            class="text-xs
                            text-slate-500">

                                {{ $order->source_language }}
                                →
                                {{ $order->target_language }}

                            </p>

                        </div>

                    </td>

                    <td class="p-4">

                        {{ $order->field }}

                    </td>

                    <td class="p-4">

                        {{ $order->user?->name }}

                    </td>

                    <td class="p-4">

                        @if($order->translator)

                            {{ $order->translator->name }}

                        @else

                            <span
                            class="text-orange-600
                            font-medium">

                                Open Market

                            </span>

                        @endif

                    </td>

                    <td
                    class="p-4 text-center">

                        {{ $order->requests->count() }}

                    </td>

                    <td class="p-4">

                        <span
                        class="px-3 py-1
                        rounded-full
                        text-xs font-medium

                        @if($order->status == 'open')
                            bg-orange-100 text-orange-700
                        @elseif($order->status == 'in_progress')
                            bg-blue-100 text-blue-700
                        @elseif($order->status == 'revision')
                            bg-yellow-100 text-yellow-700
                        @elseif($order->status == 'completed')
                            bg-green-100 text-green-700
                        @elseif($order->status == 'cancelled')
                            bg-red-100 text-red-700
                        @endif">

                            {{ str_replace('_',' ', ucfirst($order->status)) }}

                        </span>

                    </td>

                    <td
                    class="p-4 text-right
                    font-semibold
                    text-green-600">

                        Rp {{ number_format($order->price) }}

                    </td>

                    <td
                    class="p-4 text-center">

                        <a
                        href="{{ route('admin.orders.show',$order) }}"
                        class="bg-blue-600
                        hover:bg-blue-700
                        text-white
                        px-4 py-2
                        rounded-lg
                        text-sm">

                            View

                        </a>

                    </td>

                </tr>

                @empty

                <tr>

                    <td
                    colspan="9"
                    class="p-12
                    text-center
                    text-slate-500">

                        No orders found.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@if($orders->hasPages())

<div class="mt-6">

    {{ $orders->links() }}

</div>

@endif

@endsection