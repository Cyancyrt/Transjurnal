@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto space-y-8">

    {{-- Hero --}}
    <div class="bg-gradient-to-r from-slate-900 via-indigo-900 to-blue-900 rounded-3xl p-10 text-white">

        <div class="flex flex-col lg:flex-row justify-between gap-6">

            <div>

                <p class="text-indigo-200 uppercase tracking-widest text-sm">
                    Translation Workspace
                </p>

                <h1 class="text-4xl font-bold mt-3">
                    {{ $order->title }}
                </h1>

                <p class="mt-4 text-indigo-200">
                    {{ $order->field }}
                </p>

            </div>

            <div>

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
                        <span class="bg-yellow-500 px-5 py-3 rounded-xl font-semibold text-black">
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
                            Open
                        </span>

                @endswitch

            </div>

        </div>

    </div>

    {{-- Overview --}}
    <div class="grid md:grid-cols-4 gap-6">

        <div class="bg-white rounded-2xl p-6 shadow-sm">

            <p class="text-slate-500 text-sm">
                Client
            </p>

            <h3 class="text-xl font-bold mt-2">
                {{ $order->user?->name }}
            </h3>

        </div>

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

    <div class="grid lg:grid-cols-3 gap-8">

        {{-- Left Content --}}
        <div class="lg:col-span-2 space-y-8">

            {{-- Description --}}
            <div class="bg-white rounded-2xl shadow-sm p-8">

                <h2 class="text-2xl font-bold mb-6">
                    Project Description
                </h2>

                <p class="leading-8 text-slate-600">
                    {{ $order->description }}
                </p>

            </div>

            {{-- Translation Details --}}
            <div class="bg-white rounded-2xl shadow-sm p-8">

                <h2 class="text-2xl font-bold mb-6">
                    Translation Details
                </h2>

                <div class="grid md:grid-cols-2 gap-8">

                    <div>

                        <p class="text-slate-500 text-sm">
                            Source Language
                        </p>

                        <p class="font-semibold text-lg mt-1">
                            {{ $order->source_language }}
                        </p>

                    </div>

                    <div>

                        <p class="text-slate-500 text-sm">
                            Target Language
                        </p>

                        <p class="font-semibold text-lg mt-1">
                            {{ $order->target_language }}
                        </p>

                    </div>

                </div>

            </div>

            {{-- Progress --}}
            <div class="bg-white rounded-2xl shadow-sm p-8">

                <h2 class="text-2xl font-bold mb-8">
                    Workflow Progress
                </h2>

                @php

                    $steps = [
                        [
                            'key' => 'open',
                            'label' => 'Open'
                        ],
                        [
                            'key' => 'in_progress',
                            'label' => 'In Progress'
                        ],
                        [
                            'key' => 'revision',
                            'label' => 'Revision'
                        ],
                        [
                            'key' => 'completed',
                            'label' => 'Completed'
                        ]
                    ];

                    switch($order->status)
                    {
                        case 'open':
                            $currentStep = 0;
                            break;

                        case 'in_progress':
                            $currentStep = 1;
                            break;

                        case 'revision':
                            $currentStep = 2;
                            break;

                        case 'completed':
                            $currentStep = 3;
                            break;

                        case 'cancelled':
                            $currentStep = -1;
                            break;

                        default:
                            $currentStep = 0;
                            break;
                    }

                @endphp
                @if($order->status == 'cancelled')

                    <div class="bg-red-50 border border-red-200 rounded-2xl p-8">

                        <div class="flex items-center gap-3">

                            <div
                                class="w-12 h-12 rounded-full bg-red-500 text-white flex items-center justify-center"
                            >
                                <i class="bi bi-x-lg"></i>
                            </div>

                            <div>

                                <h3 class="font-bold text-red-700">
                                    Order Cancelled
                                </h3>

                                <p class="text-red-600 text-sm mt-1">
                                    This project has been cancelled and can no longer proceed.
                                </p>

                            </div>

                        </div>

                    </div>

                @else

                <div class="flex items-center">

                    @foreach($steps as $index => $step)

                        @php

                            $completed = $index < $currentStep;

                            $active = $index == $currentStep;

                        @endphp

                        <div class="flex flex-col items-center">

                            <div
                                class="
                                    w-14 h-14 rounded-full
                                    flex items-center justify-center
                                    transition-all

                                    @if($completed)
                                        bg-green-500 text-white
                                    @elseif($active)
                                        bg-blue-600 text-white ring-4 ring-blue-100
                                    @else
                                        bg-slate-200 text-slate-500
                                    @endif
                                "
                            >

                                @if($completed)

                                    <i class="bi bi-check-lg"></i>

                                @elseif($active)

                                    <i class="bi bi-hourglass-split"></i>

                                @else

                                    <i class="bi bi-circle"></i>

                                @endif

                            </div>

                            <span
                                class="
                                    mt-3
                                    text-sm
                                    font-medium
                                    text-center

                                    @if($active)
                                        text-blue-600
                                    @elseif($completed)
                                        text-green-600
                                    @else
                                        text-slate-500
                                    @endif
                                "
                            >
                                {{ $step['label'] }}
                            </span>

                        </div>

                        @if(!$loop->last)

                            <div
                                class="
                                    flex-1 h-1 mx-4 rounded-full

                                    @if($index < $currentStep)
                                        bg-green-500
                                    @else
                                        bg-slate-200
                                    @endif
                                "
                            ></div>

                        @endif

                    @endforeach

                </div>

                @endif

            </div>

            {{-- Review --}}
            @if($order->review)

            <div class="bg-white rounded-2xl shadow-sm p-8">

                <h2 class="text-2xl font-bold mb-6">
                    Client Review
                </h2>

                <div class="text-yellow-500 text-xl">

                    @for($i=1;$i<=5;$i++)

                        {{ $i <= $order->review->rating ? '★' : '☆' }}

                    @endfor

                </div>

                <p class="mt-4 text-slate-600 leading-8">

                    {{ $order->review->comment }}

                </p>

                <div class="mt-4 text-sm text-slate-500">

                    {{ $order->review->user?->name }}

                </div>

            </div>

            @endif

        </div>

        {{-- Sidebar --}}
        <div>

            <div class="bg-white rounded-2xl shadow-sm p-8 sticky top-8">

                <h2 class="text-xl font-bold mb-6">
                    Workspace Actions
                </h2>

                <div class="space-y-4">

                    <a
                        href="{{ asset('storage/'.$order->journal_file) }}"
                        target="_blank"
                        class="block text-center bg-slate-900 text-white py-3 rounded-xl hover:bg-slate-800 transition"
                    >
                        <i class="bi bi-file-earmark-pdf"></i>
                        Download Journal
                    </a>

                    @if($order->translated_file)

                        <a
                            href="{{ asset('storage/'.$order->translated_file) }}"
                            target="_blank"
                            class="block text-center bg-green-600 text-white py-3 rounded-xl hover:bg-green-700 transition"
                        >
                            <i class="bi bi-file-earmark-check"></i>
                            View Translation
                        </a>

                    @endif

                </div>

                <hr class="my-8">

                {{-- Update Status --}}
                <form
                    action="{{ route('translator.orders.status',$order) }}"
                    method="POST"
                >

                    @csrf
                    @method('PATCH')

                    <label class="block font-semibold mb-3">

                        Update Status

                    </label>

                    <select
                        name="status"
                        class="w-full border rounded-xl px-4 py-3"
                    >

                        <option value="open"
                            @selected($order->status == 'open')>
                            Open
                        </option>

                        <option value="in_progress"
                            @selected($order->status == 'in_progress')>
                            In Progress
                        </option>

                        <option value="revision"
                            @selected($order->status == 'revision')>
                            Revision
                        </option>

                        <option value="completed"
                            @selected($order->status == 'completed')>
                            Completed
                        </option>

                        <option value="cancelled"
                            @selected($order->status == 'cancelled')>
                            Cancelled
                        </option>

                    </select>

                    <button
                        type="submit"
                        class="w-full mt-4 bg-indigo-600 text-white py-3 rounded-xl hover:bg-indigo-700 transition"
                    >
                        Save Status
                    </button>

                </form>

                <hr class="my-8">

                {{-- Upload Translation --}}
                <form
                    action="{{ route('translator.orders.upload',$order) }}"
                    method="POST"
                    enctype="multipart/form-data"
                >

                    @csrf

                    <label class="block font-semibold mb-3">

                        Upload Translation

                    </label>

                    <input
                        type="file"
                        name="translated_file"
                        accept=".pdf,.doc,.docx"
                        class="w-full border rounded-xl p-3"
                    >

                    <button
                        type="submit"
                        class="w-full mt-4 bg-green-600 text-white py-3 rounded-xl hover:bg-green-700 transition"
                    >
                        Upload Result
                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection