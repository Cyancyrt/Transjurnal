@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto space-y-8">

    {{-- Header --}}
    <div class="bg-gradient-to-r from-slate-900 to-indigo-900 rounded-3xl p-10 text-white">

        <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center gap-6">

            <div>

                <p class="text-indigo-200">
                    Translation Assignment
                </p>

                <h1 class="text-4xl font-bold mt-2">
                    {{ $order->title }}
                </h1>

                <p class="mt-3 text-indigo-200">
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

            {{-- Translation Detail --}}
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

            {{-- Update Status --}}
            <div class="bg-white rounded-2xl shadow-sm p-8">

                <h2 class="text-2xl font-bold mb-6">
                    Update Status
                </h2>

                <form
                    action="{{ route('translator.orders.status', $order) }}"
                    method="POST"
                >
                    @csrf
                    @method('PATCH')

                    <div class="flex gap-4">

                        <select
                            name="status"
                            class="flex-1 border rounded-xl px-4 py-3"
                        >
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
                        </select>

                        <button
                            type="submit"
                            class="bg-indigo-600 text-white px-6 rounded-xl"
                        >
                            Update
                        </button>

                    </div>

                </form>

            </div>

        </div>

        {{-- Right Sidebar --}}
        <div>

            <div class="bg-white rounded-2xl shadow-sm p-8 sticky top-8">

                <h2 class="text-xl font-bold mb-6">
                    Actions
                </h2>

                <div class="space-y-4">

                    <a
                        href="{{ asset('storage/'.$order->journal_file) }}"
                        target="_blank"
                        class="block w-full text-center bg-slate-900 text-white py-3 rounded-xl"
                    >
                        Download Journal
                    </a>

                    <a
                        href="{{ route('translator.orders.work',$order) }}"
                        class="block w-full text-center bg-indigo-600 text-white py-3 rounded-xl"
                    >
                        Open Workspace
                    </a>

                    @if($order->translated_file)

                        <a
                            href="{{ asset('storage/'.$order->translated_file) }}"
                            target="_blank"
                            class="block w-full text-center bg-green-600 text-white py-3 rounded-xl"
                        >
                            View Uploaded Translation
                        </a>

                    @endif

                </div>

                <hr class="my-6">

                <h3 class="font-bold mb-4">
                    Client Information
                </h3>

                <div class="space-y-3 text-sm">

                    <div>
                        <span class="text-slate-500">
                            Name
                        </span>
                        <div class="font-medium">
                            {{ $order->user?->name }}
                        </div>
                    </div>

                    <div>
                        <span class="text-slate-500">
                            Email
                        </span>
                        <div class="font-medium">
                            {{ $order->user?->email }}
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection