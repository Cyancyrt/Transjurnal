@extends('layouts.app')

@section('content')

<div class="space-y-10">

    <div class="bg-gradient-to-r from-indigo-700 to-blue-700 rounded-3xl p-10 text-white">

        <h1 class="text-4xl font-bold">
            Welcome Back, {{ auth()->user()->name }}
        </h1>

        <p class="mt-3 text-indigo-100">
            Translate your academic journals with verified scholars.
        </p>

        <a
            href="{{ route('user.orders.create') }}"
            class="inline-block mt-6 px-6 py-3 bg-white text-indigo-700 rounded-xl font-semibold"
        >
            New Translation Request
        </a>

    </div>
    <section>

    <div class="flex items-center justify-between mb-6">

        <h2 class="text-2xl font-bold">
            Featured Scholars
        </h2>

        <a
            href="{{ route('user.scholars.index') }}"
            class="text-indigo-600 font-semibold hover:text-indigo-700"
        >
            View All
        </a>

    </div>

    <div class="relative">

        {{-- Left Button --}}
        <button
            type="button"
            onclick="scrollScholars(-350)"
            class="absolute left-0 top-1/2 -translate-y-1/2 z-10 bg-white shadow-lg border rounded-full w-12 h-12 flex items-center justify-center hover:bg-slate-50"
        >
            <i class="bi bi-chevron-left"></i>
        </button>

        {{-- Right Button --}}
        <button
            type="button"
            onclick="scrollScholars(350)"
            class="absolute right-0 top-1/2 -translate-y-1/2 z-10 bg-white shadow-lg border rounded-full w-12 h-12 flex items-center justify-center hover:bg-slate-50"
        >
            <i class="bi bi-chevron-right"></i>
        </button>

        {{-- Slider --}}
        <div
            id="scholar-slider"
            class="flex gap-6 overflow-x-auto scroll-smooth px-14 pb-4"
            style="
                scrollbar-width:none;
                -ms-overflow-style:none;
            "
        >

            @forelse($featuredScholars as $scholar)

                <div
                    class="bg-white rounded-2xl shadow-sm overflow-hidden min-w-[320px] max-w-[320px] flex-shrink-0 border border-slate-200"
                >

                    {{-- Cover --}}
                    <div class="h-24 bg-gradient-to-r from-indigo-600 to-blue-600"></div>

                    <div class="p-6">

                        {{-- Avatar --}}
                        <div class="w-20 h-20 rounded-full bg-slate-200 border-4 border-white -mt-16 flex items-center justify-center">

                            <i class="bi bi-person-fill text-3xl text-slate-500"></i>

                        </div>

                        {{-- Name --}}
                        <h3 class="mt-4 text-lg font-bold text-slate-900">

                            {{ $scholar->academic_title }}

                            {{ $scholar->user->name }}

                        </h3>

                        <p class="text-sm text-slate-500 mt-1">

                            {{ $scholar->university }}

                        </p>

                        {{-- Expertise --}}
                        <div class="mt-4">

                            <span class="inline-flex px-3 py-1 bg-indigo-100 text-indigo-700 rounded-full text-xs">

                                {{ $scholar->expertise }}

                            </span>

                        </div>

                        {{-- Stats --}}
                        <div class="mt-5 space-y-3">

                            <div class="flex justify-between">

                                <span class="text-slate-500 text-sm">
                                    Publications
                                </span>

                                <span class="font-semibold">
                                    {{ $scholar->publication_count }}
                                </span>

                            </div>

                            <div class="flex justify-between">

                                <span class="text-slate-500 text-sm">
                                    Hourly Rate
                                </span>

                                <span class="font-semibold text-green-600">

                                    Rp {{ number_format($scholar->hourly_rate,0,',','.') }}

                                </span>

                            </div>

                            <div class="flex justify-between">

                                <span class="text-slate-500 text-sm">
                                    Status
                                </span>

                                <span class="font-semibold text-green-600">

                                    {{ ucfirst($scholar->verification_status) }}

                                </span>

                            </div>

                        </div>

                        {{-- Button --}}
                        <a
                            href="{{ route('user.scholars.show', $scholar) }}"
                            class="block mt-6 w-full text-center bg-indigo-600 text-white py-3 rounded-xl font-medium hover:bg-indigo-700 transition"
                        >
                            View Profile
                        </a>

                    </div>

                </div>

            @empty

                <div class="w-full">

                    <div class="bg-white p-10 rounded-2xl text-center text-slate-500 shadow-sm">

                        <i class="bi bi-mortarboard text-5xl"></i>

                        <p class="mt-4">
                            No verified scholars available.
                        </p>

                    </div>

                </div>

            @endforelse

        </div>

    </div>

</section>

    <section>

        <h2 class="text-2xl font-bold mb-6">
            Translation Services
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            @forelse($services as $service)

                <div class="bg-white rounded-2xl p-6 shadow-sm">

                    <h3 class="text-lg font-bold">
                        {{ $service->name }}
                    </h3>

                    <p class="mt-2 text-gray-500">
                        {{ $service->description }}
                    </p>

                    <div class="mt-6">

                        <p class="text-3xl font-bold">

                            Rp {{ number_format($service->base_price,0,',','.') }}

                        </p>

                    </div>

                    <button
                        class="w-full mt-5 bg-indigo-600 text-white py-2 rounded-lg"
                    >
                        Order Service
                    </button>

                </div>

            @empty

                <div class="col-span-3">

                    <div class="bg-white p-8 rounded-2xl text-center text-gray-500">

                        No services available.

                    </div>

                </div>

            @endforelse

        </div>

    </section>

    <section>

        <div class="bg-white rounded-2xl shadow-sm overflow-hidden">

            <div class="p-6 border-b">

                <h2 class="text-2xl font-bold">
                    My Recent Orders
                </h2>

            </div>

            <table class="w-full">

                <thead>

                    <tr class="bg-gray-50">

                        <th class="p-4 text-left">
                            Journal
                        </th>

                        <th class="p-4 text-left">
                            Service
                        </th>

                        <th class="p-4 text-left">
                            Translator
                        </th>

                        <th class="p-4 text-left">
                            Status
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($recentOrders as $order)

                        <tr class="border-t">

                            <td class="p-4">
                                {{ $order->title }}
                            </td>

                            <td class="p-4">
                                {{ $order->service?->name }}
                            </td>

                            <td class="p-4">
                                {{ $order->translator?->name ?? 'Not Assigned' }}
                            </td>

                            <td class="p-4">

                                <span class="px-3 py-1 rounded-full bg-slate-100 text-slate-700 text-sm">

                                    {{ ucfirst($order->status) }}

                                </span>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="4" class="p-8 text-center text-gray-500">

                                You don't have any orders yet.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </section>

    <section>

        <h2 class="text-2xl font-bold mb-6">
            Completed Translations
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

            @forelse($completedTranslations as $order)

                <div class="bg-white rounded-2xl shadow-sm p-6">

                    <h3 class="font-bold text-lg">

                        {{ $order->title }}

                    </h3>

                    <p class="mt-2 text-gray-500">

                        Translator:

                        {{ $order->translator?->name }}

                    </p>

                    <p class="text-sm text-gray-400 mt-2">

                        Completed

                        {{ $order->updated_at->format('d M Y') }}

                    </p>

                    @if($order->translated_file)

                        <a
                            href="{{ asset('storage/' . $order->translated_file) }}"
                            class="inline-block mt-5 px-4 py-2 bg-green-600 text-white rounded-lg"
                        >
                            Download Result
                        </a>

                    @endif

                </div>

            @empty

                <div class="col-span-3">

                    <div class="bg-white p-8 rounded-2xl text-center text-gray-500">

                        No completed translations yet.

                    </div>

                </div>

            @endforelse

        </div>

    </section>

</div>

<style>

#scholar-slider::-webkit-scrollbar
{
    display: none;
}

</style>

<script>

function scrollScholars(distance)
{
    document
        .getElementById('scholar-slider')
        .scrollBy({
            left: distance,
            behavior: 'smooth'
        });
}

</script>
@endsection