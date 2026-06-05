@extends('layouts.app')

@section('content')

<div class="space-y-8">

    {{-- Header --}}
    <div class="bg-gradient-to-r from-indigo-600 to-blue-600 rounded-3xl p-10 text-white">

        <div class="flex justify-between items-center">

            <div>

                <h1 class="text-4xl font-bold">
                    My Orders
                </h1>

                <p class="mt-3 text-indigo-100">
                    Track and manage all your translation projects.
                </p>

            </div>

            <a
                href="{{ route('user.orders.create') }}"
                class="bg-white text-indigo-700 px-6 py-3 rounded-xl font-semibold"
            >
                New Order
            </a>

        </div>

    </div>

    {{-- Orders --}}
    <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-6">

        @forelse($orders as $order)

            <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">

                <div class="p-6 border-b">

                    <div class="flex justify-between items-start">

                        <h2 class="text-xl font-bold">

                            {{ $order->title }}

                        </h2>

                        @switch($order->status)

                            @case('completed')

                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                                    Completed
                                </span>

                                @break

                            @case('in_progress')

                                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">
                                    In Progress
                                </span>

                                @break

                            @case('revision')

                                <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">
                                    Revision
                                </span>

                                @break

                            @case('cancelled')

                                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">
                                    Cancelled
                                </span>

                                @break

                            @default

                                <span class="bg-slate-100 text-slate-700 px-3 py-1 rounded-full text-sm">
                                    {{ ucfirst($order->status) }}
                                </span>

                        @endswitch

                    </div>

                    <p class="text-slate-500 mt-2">

                        {{ $order->field }}

                    </p>

                </div>

                <div class="p-6 space-y-4">

                    <div class="flex items-center gap-3">

                        <i class="bi bi-briefcase-fill text-slate-400"></i>

                        <span>

                            {{ $order->service?->name }}

                        </span>

                    </div>

                    <div class="flex items-center gap-3">

                        <i class="bi bi-person-fill text-slate-400"></i>

                        <span>

                            {{ $order->translator?->name ?? 'Waiting for Translator' }}

                        </span>

                    </div>

                    <div class="flex items-center gap-3">

                        <i class="bi bi-translate text-slate-400"></i>

                        <span>

                            {{ $order->source_language }}

                            →

                            {{ $order->target_language }}

                        </span>

                    </div>

                    <div class="flex items-center gap-3">

                        <i class="bi bi-cash-stack text-slate-400"></i>

                        <span>

                            Rp {{ number_format($order->price,0,',','.') }}

                        </span>

                    </div>

                </div>

                <div class="px-6 pb-6">

                    <div class="flex gap-3">

                        <a
                            href="{{ route('user.orders.show', $order) }}"
                            class="flex-1 text-center py-3 rounded-xl bg-indigo-600 text-white"
                        >
                            View Detail
                        </a>

                        @if($order->translated_file)

                            <a
                                href="{{ asset('storage/' . $order->translated_file) }}"
                                class="px-4 py-3 rounded-xl bg-green-600 text-white"
                            >
                                <i class="bi bi-download"></i>
                            </a>

                        @endif

                    </div>

                </div>

            </div>

        @empty

            <div class="col-span-full">

                <div class="bg-white rounded-3xl p-16 text-center shadow-sm">

                    <i class="bi bi-journal-text text-6xl text-slate-300"></i>

                    <h2 class="text-2xl font-bold mt-6">
                        No Orders Yet
                    </h2>

                    <p class="text-slate-500 mt-2">
                        You haven't created any translation requests.
                    </p>

                    <a
                        href="{{ route('user.orders.create') }}"
                        class="inline-block mt-6 px-6 py-3 bg-indigo-600 text-white rounded-xl"
                    >
                        Create Your First Order
                    </a>

                </div>

            </div>

        @endforelse

    </div>

    <div>

        {{ $orders->links() }}

    </div>

</div>

@endsection