@extends('layouts.admin')

@section('page-title', 'Services Management')

@section('content')

<div class="space-y-6">

    <div class="flex items-center justify-between">

        <div>

            <h1 class="text-2xl font-bold text-slate-800">
                Services Management
            </h1>

            <p class="text-sm text-slate-500 mt-1">
                Manage translation services available on the platform.
            </p>

        </div>

        <a
        href="{{ route('admin.services.create') }}"
        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl transition">

            <i class="bi bi-plus-lg mr-2"></i>

            Add Service

        </a>

    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">

        <div class="bg-white border border-slate-200 rounded-2xl p-5">

            <p class="text-xs uppercase text-slate-500">
                Total Services
            </p>

            <h2 class="text-3xl font-bold mt-2">
                {{ $stats['total'] }}
            </h2>

        </div>

        <div class="bg-white border border-slate-200 rounded-2xl p-5">

            <p class="text-xs uppercase text-slate-500">
                Average Price
            </p>

            <h2 class="text-3xl font-bold text-green-600 mt-2">
                Rp {{ number_format($stats['average_price']) }}
            </h2>

        </div>

        <div class="bg-white border border-slate-200 rounded-2xl p-5">

            <p class="text-xs uppercase text-slate-500">
                Total Orders
            </p>

            <h2 class="text-3xl font-bold text-blue-600 mt-2">
                {{ $stats['orders'] }}
            </h2>

        </div>

        <div class="bg-white border border-slate-200 rounded-2xl p-5">

            <p class="text-xs uppercase text-slate-500">
                Revenue
            </p>

            <h2 class="text-2xl font-bold text-purple-600 mt-2">
                Rp {{ number_format($stats['revenue']) }}
            </h2>

        </div>

    </div>

    <div class="bg-white border border-slate-200 rounded-2xl p-4">

        <form
            method="GET"
            action="{{ route('admin.services.index') }}"
            class="flex gap-3">

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search service..."
                class="flex-1 border border-slate-300 rounded-xl px-4 py-2.5">

            <button
                type="submit"
                class="bg-slate-800 text-white px-5 rounded-xl">

                Search

            </button>

            @if(request('search'))

                <a
                href="{{ route('admin.services.index') }}"
                class="px-5 py-2.5 border border-slate-300 rounded-xl hover:bg-slate-50">

                    Reset

                </a>

            @endif

        </form>

    </div>

    <div
    class="bg-white border border-slate-200 rounded-2xl overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead>

                    <tr class="bg-slate-50 border-b">

                        <th class="px-5 py-4 text-left text-xs uppercase text-slate-500">
                            Service
                        </th>

                        <th class="px-5 py-4 text-left text-xs uppercase text-slate-500">
                            Base Price
                        </th>

                        <th class="px-5 py-4 text-left text-xs uppercase text-slate-500">
                            Orders
                        </th>

                        <th class="px-5 py-4 text-left text-xs uppercase text-slate-500">
                            Revenue
                        </th>

                        <th class="px-5 py-4 text-center text-xs uppercase text-slate-500">
                            Action
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($services as $service)

                    <tr class="border-b hover:bg-slate-50">

                        <td class="px-5 py-4">

                            <div>

                                <p class="font-medium text-slate-800">

                                    {{ $service->name }}

                                </p>

                                <p class="text-xs text-slate-500 mt-1">

                                    {{ $service->short_description }}

                                </p>

                            </div>

                        </td>

                        <td class="px-5 py-4">

                            <span class="font-medium text-green-600">

                                Rp {{ number_format($service->base_price) }}

                            </span>

                        </td>

                        <td class="px-5 py-4">

                            {{ $service->orders_count }}

                        </td>

                        <td class="px-5 py-4">

                            Rp {{ number_format($service->orders_sum_price ?? 0) }}

                        </td>

                        <td class="px-5 py-4">

                            <div class="flex justify-center gap-2">

                                <a
                                href="{{ route('admin.services.show', $service) }}"
                                class="w-9 h-9 rounded-lg border flex items-center justify-center hover:bg-slate-100">

                                    <i class="bi bi-eye"></i>

                                </a>

                                <a
                                href="{{ route('admin.services.edit', $service) }}"
                                class="w-9 h-9 rounded-lg border flex items-center justify-center hover:bg-slate-100">

                                    <i class="bi bi-pencil"></i>

                                </a>

                                <form
                                    method="POST"
                                    action="{{ route('admin.services.destroy', $service) }}"
                                    onsubmit="return confirm('Delete this service?')">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                    class="w-9 h-9 rounded-lg border flex items-center justify-center hover:bg-red-50 text-red-600">

                                        <i class="bi bi-trash"></i>

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td
                        colspan="5"
                        class="text-center py-12 text-slate-500">

                            No services found.

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

    @if($services->hasPages())

        <div>

            {{ $services->links() }}

        </div>

    @endif

</div>

@endsection