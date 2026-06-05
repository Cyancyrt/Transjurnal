@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto space-y-8">

    {{-- Header --}}
    <div class="bg-gradient-to-r from-indigo-600 to-blue-600 rounded-3xl p-10 text-white">

        <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center gap-6">

            <div>

                <p class="text-indigo-100">
                    Translation Project
                </p>

                <h1 class="text-4xl font-bold mt-2">

                    {{ $order->title }}

                </h1>

                <p class="mt-3 text-indigo-100">

                    {{ $order->field }}

                </p>

            </div>

            <div>
                {{-- @dd($order->status) --}}
                @switch($order->status)

                    @case('completed')

                        <span class="bg-green-500 px-5 py-3 rounded-xl font-semibold">
                            Completed
                        </span>

                        @break

                    @case('in_progress')

                        <span class="bg-blue-500 px-5 py-3 rounded-xl font-semibold">
                            In Progress
                        </span>

                        @break

                    @case('revision')

                        <span class="bg-yellow-500 px-5 py-3 rounded-xl font-semibold">
                            Revision
                        </span>

                        @break

                    @case('cancelled')

                        <span class="bg-red-500 px-5 py-3 rounded-xl font-semibold">
                            Cancelled
                        </span>

                        @break

                    @default

                        <span class="bg-slate-500 px-5 py-3 rounded-xl font-semibold">
                            {{ ucfirst($order->status) }}
                        </span>

                @endswitch

            </div>

        </div>

    </div>

    {{-- Stats --}}
    <div class="grid md:grid-cols-4 gap-6">

        <div class="bg-white rounded-2xl p-6 shadow-sm">

            <p class="text-slate-500 text-sm">
                Service
            </p>

            <h3 class="text-xl font-bold mt-2">

                {{ $order->service?->name }}

            </h3>

        </div>

        <div class="bg-white rounded-2xl p-6 shadow-sm">

            <p class="text-slate-500 text-sm">
                Translator
            </p>

            <h3 class="text-xl font-bold mt-2">

                {{ $order->translator?->name ?? 'Not Assigned' }}

            </h3>

        </div>

        <div class="bg-white rounded-2xl p-6 shadow-sm">

            <p class="text-slate-500 text-sm">
                Price
            </p>

            <h3 class="text-xl font-bold mt-2">

                Rp {{ number_format($order->price,0,',','.') }}

            </h3>

        </div>

        <div class="bg-white rounded-2xl p-6 shadow-sm">

            <p class="text-slate-500 text-sm">
                Created
            </p>

            <h3 class="text-xl font-bold mt-2">

                {{ $order->created_at->format('d M Y') }}

            </h3>

        </div>

    </div>

    {{-- Main Content --}}
    <div class="grid lg:grid-cols-3 gap-8">

        {{-- Left --}}
        <div class="lg:col-span-2 space-y-8">

            {{-- Description --}}
            <div class="bg-white rounded-2xl shadow-sm p-8">

                <h2 class="text-2xl font-bold mb-5">
                    Project Description
                </h2>

                <p class="text-slate-600 leading-8">

                    {{ $order->description }}

                </p>

            </div>

            {{-- Language --}}
            <div class="bg-white rounded-2xl shadow-sm p-8">

                <h2 class="text-2xl font-bold mb-5">
                    Translation Details
                </h2>

                <div class="grid md:grid-cols-2 gap-6">

                    <div>

                        <p class="text-slate-500 text-sm">
                            Source Language
                        </p>

                        <p class="font-semibold text-lg">

                            {{ $order->source_language }}

                        </p>

                    </div>

                    <div>

                        <p class="text-slate-500 text-sm">
                            Target Language
                        </p>

                        <p class="font-semibold text-lg">

                            {{ $order->target_language }}

                        </p>

                    </div>

                </div>

            </div>

        {{-- Progress --}}
        <div class="bg-white rounded-2xl shadow-sm p-8">

            <h2 class="text-2xl font-bold mb-8">
                Translation Progress
            </h2>

            @if($order->status === 'cancelled')

                <div class="bg-red-50 border border-red-200 rounded-xl p-6">

                    <h3 class="font-semibold text-red-700">
                        Order Cancelled
                    </h3>

                    <p class="text-red-600 mt-2">
                        This translation request has been cancelled.
                    </p>

                </div>

            @else

                @php

                    $steps = [
                        'open' => 'Open',
                        'in_progress' => 'In Progress',
                        'revision' => 'Revision',
                        'completed' => 'Completed',
                    ];

                    $currentStep = array_search(
                        $order->status,
                        array_keys($steps)
                    );

                @endphp

                <div class="flex items-center">

                    @foreach($steps as $key => $label)

                        @php
                            $stepIndex = array_search(
                                $key,
                                array_keys($steps)
                            );

                            $completed =
                                $stepIndex <= $currentStep;
                        @endphp

                        <div class="flex flex-col items-center">

                            <div
                                class="w-12 h-12 rounded-full flex items-center justify-center
                                {{ $completed
                                    ? 'bg-green-500 text-white'
                                    : 'bg-slate-300 text-slate-500' }}">

                                @if($completed)

                                    <i class="bi bi-check-lg"></i>

                                @else

                                    <i class="bi bi-circle"></i>

                                @endif

                            </div>

                            <span class="mt-2 text-sm text-center">

                                {{ $label }}

                            </span>

                        </div>

                        @if(!$loop->last)

                            <div
                                class="flex-1 h-1 mx-3
                                {{ $stepIndex < $currentStep
                                    ? 'bg-green-500'
                                    : 'bg-slate-300' }}">
                            </div>

                        @endif

                    @endforeach

                </div>

            @endif

        </div>

        </div>

        {{-- Right --}}
        <div>

            <div class="bg-white rounded-2xl shadow-sm p-8 sticky top-8">

                <h2 class="text-xl font-bold mb-6">
                    Files
                </h2>

                <div class="space-y-4">

                    <a
                        href="{{ asset('storage/' . $order->journal_file) }}"
                        target="_blank"
                        class="block w-full text-center bg-slate-900 text-white py-3 rounded-xl"
                    >
                        Original Journal
                    </a>

                    @if($order->translated_file)

                        <a
                            href="{{ asset('storage/' . $order->translated_file) }}"
                            target="_blank"
                            class="block w-full text-center bg-green-600 text-white py-3 rounded-xl"
                        >
                            Download Translation
                        </a>

                    @endif

                </div>

                @if($order->status == 'open')

                    <a
                        href="{{ route('user.orders.edit', $order) }}"
                        class="block w-full mt-6 text-center bg-indigo-600 text-white py-3 rounded-xl"
                    >
                        Edit Order
                    </a>

                @endif

                @if(!in_array($order->status, ['in_progress','completed']))

                    <form
                        action="{{ route('user.orders.destroy', $order) }}"
                        method="POST"
                        class="mt-4"
                    >
                        @csrf
                        @method('DELETE')

                        <button
                            onclick="return confirm('Delete this order?')"
                            class="w-full bg-red-600 text-white py-3 rounded-xl"
                        >
                            Delete Order
                        </button>

                    </form>

                @endif

            </div>

        </div>

    </div>

</div>

@endsection