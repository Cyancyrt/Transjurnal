@extends('layouts.admin')

@section('page-title', 'Order Detail')

@section('content')

<div class="space-y-6">

    {{-- HEADER --}}

    <div
    class="bg-white
    border border-slate-200
    rounded-2xl
    p-6">

        <div class="flex items-start justify-between">

            <div>

                <p class="text-sm text-slate-500">

                    Order #{{ $order->id }}

                </p>

                <h1
                class="text-2xl font-bold
                text-slate-800 mt-2">

                    {{ $order->title }}

                </h1>

                <p
                class="text-slate-500 mt-2">

                    {{ $order->field }}

                </p>

            </div>

            <div>

                <span
                class="px-4 py-2 rounded-full text-sm font-medium

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

                    {{ str_replace('_', ' ', ucfirst($order->status)) }}

                </span>

            </div>

        </div>

    </div>

    {{-- CONTENT --}}

    <div class="grid lg:grid-cols-3 gap-6">

        {{-- LEFT COLUMN --}}

        <div class="lg:col-span-2 space-y-6">

            {{-- DESCRIPTION --}}

            <div
            class="bg-white
            border border-slate-200
            rounded-2xl
            p-6">

                <h3
                class="font-semibold
                text-slate-800 mb-4">

                    Journal Description

                </h3>

                <p
                class="text-slate-600
                leading-relaxed">

                    {{ $order->description }}

                </p>

            </div>

            {{-- JOURNAL FILE --}}

            <div
            class="bg-white
            border border-slate-200
            rounded-2xl
            p-6">

                <h3
                class="font-semibold
                text-slate-800 mb-4">

                    Journal File

                </h3>

                <div
                class="border border-dashed
                border-slate-300
                rounded-xl
                p-5">

                    <p
                    class="font-medium">

                        {{ basename($order->journal_file) }}

                    </p>

                    <p
                    class="text-sm
                    text-slate-500 mt-2">

                        Uploaded source document

                    </p>

                    <a
                    href="#"
                    class="inline-flex
                    items-center
                    mt-4
                    bg-blue-600
                    text-white
                    px-4 py-2
                    rounded-lg">

                        Download File

                    </a>

                </div>

            </div>

            {{-- REQUEST HISTORY --}}

            <div
            class="bg-white
            border border-slate-200
            rounded-2xl
            p-6">

                <h3
                class="font-semibold
                text-slate-800 mb-4">

                    Scholar Requests

                </h3>

                @forelse($order->requests as $request)

                    <div
                    class="flex items-center
                    justify-between
                    border rounded-xl
                    p-4 mb-3">

                        <div>

                            <p class="font-medium">

                                {{ $request->translator->name }}

                            </p>

                            <p
                            class="text-sm
                            text-slate-500">

                                {{ $request->translator->email }}

                            </p>

                        </div>

                        <span
                        class="px-3 py-1
                        rounded-full text-xs font-medium

                        @if($request->status == 'accepted')
                            bg-green-100 text-green-700
                        @elseif($request->status == 'rejected')
                            bg-red-100 text-red-700
                        @else
                            bg-orange-100 text-orange-700
                        @endif">

                            {{ ucfirst($request->status) }}

                        </span>

                    </div>

                @empty

                    <div
                    class="text-center
                    py-8
                    text-slate-500">

                        No scholar requests yet.

                    </div>

                @endforelse

            </div>

        </div>

        {{-- RIGHT COLUMN --}}

        <div class="space-y-6">

            {{-- CLIENT --}}

            <div
            class="bg-white
            border border-slate-200
            rounded-2xl
            p-6">

                <h3
                class="font-semibold mb-4">

                    Client

                </h3>

                <p class="font-medium">

                    {{ $order->user?->name }}

                </p>

                <p
                class="text-sm
                text-slate-500">

                    {{ $order->user?->email }}

                </p>

            </div>

            {{-- SCHOLAR --}}

            <div
            class="bg-white
            border border-slate-200
            rounded-2xl
            p-6">

                <h3
                class="font-semibold mb-4">

                    Assigned Scholar

                </h3>

                @if($order->translator)

                    <div
                    class="rounded-xl
                    bg-green-50
                    border border-green-100
                    p-4">

                        <p
                        class="font-medium">

                            {{ $order->translator->name }}

                        </p>

                        <p
                        class="text-sm
                        text-slate-500">

                            {{ $order->translator->email }}

                        </p>

                    </div>

                @else

                    <div
                    class="rounded-xl
                    bg-orange-50
                    border border-orange-100
                    p-4">

                        <p
                        class="text-orange-700">

                            Open Marketplace

                        </p>

                    </div>

                @endif

            </div>

            {{-- SERVICE --}}

            <div
            class="bg-white
            border border-slate-200
            rounded-2xl
            p-6">

                <h3
                class="font-semibold mb-4">

                    Service

                </h3>

                <p>

                    {{ $order->service?->name }}

                </p>

            </div>

            {{-- ORDER DETAILS --}}

            <div
            class="bg-white
            border border-slate-200
            rounded-2xl
            p-6">

                <h3
                class="font-semibold mb-4">

                    Order Details

                </h3>

                <div class="space-y-4">

                    <div>

                        <p class="text-xs text-slate-400">

                            Source Language

                        </p>

                        <p>

                            {{ $order->source_language }}

                        </p>

                    </div>

                    <div>

                        <p class="text-xs text-slate-400">

                            Target Language

                        </p>

                        <p>

                            {{ $order->target_language }}

                        </p>

                    </div>

                    <div>

                        <p class="text-xs text-slate-400">

                            Created At

                        </p>

                        <p>

                            {{ $order->created_at->format('d M Y H:i') }}

                        </p>

                    </div>

                </div>

            </div>

            {{-- REVENUE --}}

            <div
            class="bg-white
            border border-slate-200
            rounded-2xl
            p-6">

                <h3
                class="font-semibold mb-4">

                    Revenue Breakdown

                </h3>

                <div class="space-y-3">

                    <div class="flex justify-between">

                        <span>Total Order</span>

                        <span>

                            Rp {{ number_format($order->price) }}

                        </span>

                    </div>

                    <div class="flex justify-between">

                        <span>Platform Fee (10%)</span>

                        <span>

                            Rp {{ number_format($order->price * 0.1) }}

                        </span>

                    </div>

                    <div
                    class="flex justify-between
                    font-semibold
                    text-green-600">

                        <span>Scholar Earnings</span>

                        <span>

                            Rp {{ number_format($order->price * 0.9) }}

                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection