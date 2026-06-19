@extends('layouts.app')

@section('content')

<div class="space-y-8">

    {{-- Hero --}}
    <div class="bg-gradient-to-r from-slate-900 via-indigo-900 to-blue-900 rounded-3xl p-10 text-white">

        <div class="flex flex-col lg:flex-row justify-between gap-6">

            <div>

                <p class="uppercase tracking-widest text-indigo-200 text-sm">
                    Translator Workspace
                </p>

                <h1 class="text-4xl font-bold mt-3">
                    Assigned Orders
                </h1>

                <p class="mt-4 text-indigo-200">
                    Manage all translation projects assigned to you.
                </p>

            </div>

            <div class="grid grid-cols-2 gap-4">

                <div class="bg-white/10 backdrop-blur rounded-2xl px-6 py-5">

                    <div class="text-3xl font-bold">
                        {{ $orders->where('status','in_progress')->count() }}
                    </div>

                    <div class="text-indigo-200 text-sm">
                        In Progress
                    </div>

                </div>

                <div class="bg-white/10 backdrop-blur rounded-2xl px-6 py-5">

                    <div class="text-3xl font-bold">
                        {{ $orders->where('status','revision')->count() }}
                    </div>

                    <div class="text-indigo-200 text-sm">
                        Revision
                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- Filter --}}
    <div class="bg-white rounded-2xl shadow-sm p-6">

        <form
            method="GET"
            class="grid md:grid-cols-3 gap-4"
        >

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search title..."
                class="border border-slate-200 rounded-xl px-4 py-3"
            >

            <select
                name="status"
                class="border border-slate-200 rounded-xl px-4 py-3"
            >

                <option value="">
                    All Status
                </option>

                <option value="open"
                    @selected(request('status') == 'open')>
                    Open
                </option>

                <option value="in_progress"
                    @selected(request('status') == 'in_progress')>
                    In Progress
                </option>

                <option value="revision"
                    @selected(request('status') == 'revision')>
                    Revision
                </option>

                <option value="completed"
                    @selected(request('status') == 'completed')>
                    Completed
                </option>

                <option value="cancelled"
                    @selected(request('status') == 'cancelled')>
                    Cancelled
                </option>

            </select>

            <button
                type="submit"
                class="bg-indigo-600 text-white rounded-xl px-6 py-3 hover:bg-indigo-700"
            >
                Filter
            </button>

        </form>

    </div>

    {{-- Orders --}}
    <div class="grid xl:grid-cols-2 gap-6">

        @forelse($orders as $order)

            <div
                class="bg-white rounded-2xl shadow-sm hover:shadow-lg transition p-7 border border-slate-100"
            >

                <div class="flex justify-between items-start gap-4">

                    <div>

                        <h2 class="text-xl font-bold text-slate-800">

                            {{ $order->title }}

                        </h2>

                        <p class="text-slate-500 mt-1">

                            {{ $order->field }}

                        </p>

                    </div>

                    @switch($order->status)

                        @case('completed')

                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-medium">
                                Completed
                            </span>

                        @break

                        @case('in_progress')

                            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm font-medium">
                                In Progress
                            </span>

                        @break

                        @case('revision')

                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm font-medium">
                                Revision
                            </span>

                        @break

                        @case('cancelled')

                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-medium">
                                Cancelled
                            </span>

                        @break

                        @default

                            <span class="bg-slate-100 text-slate-700 px-3 py-1 rounded-full text-sm font-medium">
                                Open
                            </span>

                    @endswitch

                </div>

                <div class="grid grid-cols-2 gap-4 mt-6">

                    <div>

                        <p class="text-xs text-slate-500 uppercase">
                            Client
                        </p>

                        <p class="font-semibold mt-1">
                            {{ $order->user?->name }}
                        </p>

                    </div>

                    <div>

                        <p class="text-xs text-slate-500 uppercase">
                            Service
                        </p>

                        <p class="font-semibold mt-1">
                            {{ $order->service?->name }}
                        </p>

                    </div>

                    <div>

                        <p class="text-xs text-slate-500 uppercase">
                            Source
                        </p>

                        <p class="font-semibold mt-1">
                            {{ $order->source_language }}
                        </p>

                    </div>

                    <div>

                        <p class="text-xs text-slate-500 uppercase">
                            Target
                        </p>

                        <p class="font-semibold mt-1">
                            {{ $order->target_language }}
                        </p>

                    </div>

                </div>

                <div class="mt-6">

                    <p class="text-xs text-slate-500 uppercase">
                        Price
                    </p>

                    <div class="text-2xl font-bold text-green-600 mt-1">

                        Rp {{ number_format($order->price,0,',','.') }}

                    </div>

                </div>

                <div class="flex gap-3 mt-8">

                    <a
                        href="{{ route('translator.orders.show',$order) }}"
                        class="flex-1 text-center bg-slate-100 text-slate-700 py-3 rounded-xl hover:bg-slate-200"
                    >
                        <i class="bi bi-eye"></i>
                        Detail
                    </a>

                    <a
                        href="{{ route('translator.orders.work',$order) }}"
                        class="flex-1 text-center bg-indigo-600 text-white py-3 rounded-xl hover:bg-indigo-700"
                    >
                        <i class="bi bi-pencil-square"></i>
                        Workspace
                    </a>

                </div>

            </div>

        @empty

            <div class="col-span-full">

                <div class="bg-white rounded-3xl shadow-sm p-16 text-center">

                    <i class="bi bi-folder2-open text-6xl text-slate-300"></i>

                    <h2 class="text-2xl font-bold text-slate-700 mt-6">
                        No Assigned Orders
                    </h2>

                    <p class="text-slate-500 mt-2">
                        You currently don't have any active translation projects.
                    </p>

                    <a
                        href="{{ route('translator.jobs.index') }}"
                        class="inline-block mt-6 bg-indigo-600 text-white px-6 py-3 rounded-xl"
                    >
                        Browse Available Jobs
                    </a>

                </div>

            </div>

        @endforelse

    </div>

    {{-- Pagination --}}
    @if($orders->hasPages())

        <div class="bg-white rounded-2xl p-6 shadow-sm">

            {{ $orders->links() }}

        </div>

    @endif

</div>

@endsection