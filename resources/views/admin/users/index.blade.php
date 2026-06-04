@extends('layouts.admin')

@section('page-title', 'Users Management')

@section('content')

<div class="space-y-6">

    <div>

        <h1 class="text-2xl font-bold text-slate-800">
            Users Management
        </h1>

        <p class="text-sm text-slate-500 mt-1">
            Monitor customer accounts and platform activity.
        </p>

    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">

        <div class="bg-white border border-slate-200 rounded-2xl p-5">

            <p class="text-xs uppercase text-slate-500">
                Total Users
            </p>

            <h2 class="text-3xl font-bold mt-2">
                {{ $stats['total'] }}
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
                Completed Orders
            </p>

            <h2 class="text-3xl font-bold text-green-600 mt-2">
                {{ $stats['completed_orders'] }}
            </h2>

        </div>

        <div class="bg-white border border-slate-200 rounded-2xl p-5">

            <p class="text-xs uppercase text-slate-500">
                Total Spending
            </p>

            <h2 class="text-3xl font-bold text-purple-600 mt-2">
                Rp {{ number_format($stats['total_spending']) }}
            </h2>

        </div>

    </div>

    <div class="bg-white border border-slate-200 rounded-2xl p-4">

        <form
            action="{{ route('admin.users.index') }}"
            method="GET"
            class="flex gap-3">

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search user name or email..."
                class="flex-1 border border-slate-300 rounded-xl px-4 py-2.5">

            <button
                type="submit"
                class="bg-blue-600 text-white px-6 rounded-xl hover:bg-blue-700 transition">

                Search

            </button>

            @if(request('search'))

                <a
                    href="{{ route('admin.users.index') }}"
                    class="px-6 py-2.5 border border-slate-300 rounded-xl hover:bg-slate-50">

                    Reset

                </a>

            @endif

        </form>

    </div>

    <div
    class="bg-white
    border border-slate-200
    rounded-2xl
    overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead>

                    <tr class="bg-slate-50 border-b">

                        <th class="px-5 py-4 text-left text-xs uppercase text-slate-500">
                            User
                        </th>

                        <th class="px-5 py-4 text-left text-xs uppercase text-slate-500">
                            Orders
                        </th>

                        <th class="px-5 py-4 text-left text-xs uppercase text-slate-500">
                            Spending
                        </th>

                        <th class="px-5 py-4 text-left text-xs uppercase text-slate-500">
                            Joined
                        </th>

                        <th class="px-5 py-4 text-center text-xs uppercase text-slate-500">
                            Action
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($users as $user)

                    <tr class="border-b hover:bg-slate-50 transition">

                        <td class="px-5 py-4">

                            <div class="flex items-center gap-3">

                                <div
                                class="w-10 h-10 rounded-full
                                bg-blue-100 text-blue-700
                                flex items-center justify-center
                                font-semibold">

                                    {{ strtoupper(substr($user->name,0,1)) }}

                                </div>

                                <div>

                                    <p class="font-medium text-slate-800">

                                        {{ $user->name }}

                                    </p>

                                    <p class="text-xs text-slate-500">

                                        {{ $user->email }}

                                    </p>

                                </div>

                            </div>

                        </td>

                        <td class="px-5 py-4">

                            <span class="font-medium">

                                {{ $user->orders_count }}

                            </span>

                        </td>

                        <td class="px-5 py-4">

                            <span class="font-medium text-green-600">

                                Rp {{ number_format($user->orders_sum_price ?? 0) }}

                            </span>

                        </td>

                        <td class="px-5 py-4 text-slate-600">

                            {{ $user->created_at->format('d M Y') }}

                        </td>

                        <td class="px-5 py-4">

                            <div class="flex justify-center">

                                <a
                                href="{{ route('admin.users.show', $user) }}"
                                class="inline-flex items-center justify-center
                                w-10 h-10 rounded-xl
                                border border-slate-200
                                hover:bg-slate-100 transition">

                                    <i class="bi bi-eye"></i>

                                </a>

                            </div>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td
                        colspan="5"
                        class="text-center py-12">

                            <div>

                                <i class="bi bi-people text-4xl text-slate-300"></i>

                                <p class="mt-3 text-slate-500">

                                    No users found.

                                </p>

                            </div>

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

    @if($users->hasPages())

        <div class="pt-2">

            {{ $users->links() }}

        </div>

    @endif

</div>

@endsection