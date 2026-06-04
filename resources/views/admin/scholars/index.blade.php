@extends('layouts.admin')

@section('page-title', 'Scholars')

@section('content')

<div class="space-y-6">

    {{-- HEADER --}}

    <div>

        <h1 class="text-2xl font-bold text-slate-800">
            Scholars Management
        </h1>

        <p class="text-sm text-slate-500 mt-1">
            Manage academic translators and scholar verification.
        </p>

    </div>

    {{-- STATS --}}

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

        <div
        class="bg-white
        rounded-2xl
        border border-slate-200
        p-5">

            <p class="text-xs uppercase text-slate-500">

                Pending Verification

            </p>

            <h2
            class="text-3xl font-bold
            text-orange-500 mt-2">

                {{ $stats['pending'] }}

            </h2>

        </div>

        <div
        class="bg-white
        rounded-2xl
        border border-slate-200
        p-5">

            <p class="text-xs uppercase text-slate-500">

                Approved Scholars

            </p>

            <h2
            class="text-3xl font-bold
            text-green-500 mt-2">

                {{ $stats['approved'] }}

            </h2>

        </div>

        <div
        class="bg-white
        rounded-2xl
        border border-slate-200
        p-5">

            <p class="text-xs uppercase text-slate-500">

                Rejected Scholars

            </p>

            <h2
            class="text-3xl font-bold
            text-red-500 mt-2">

                {{ $stats['rejected'] }}

            </h2>

        </div>

    </div>

    {{-- FILTER --}}

    <div
    class="bg-white
    rounded-2xl
    border border-slate-200
    p-4">

        <form
        method="GET"
        action="{{ route('admin.scholars.index') }}"
        class="flex flex-col lg:flex-row gap-3">

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search scholar, university, expertise..."
                class="flex-1
                border border-slate-300
                rounded-xl
                px-4 py-2.5">

            <select
                name="status"
                class="border border-slate-300 rounded-xl px-4 py-2.5">

                <option value="all">

                    All Status

                </option>

                <option
                value="pending"
                {{ request('status') == 'pending' ? 'selected' : '' }}>

                    Pending

                </option>

                <option
                value="approved"
                {{ request('status') == 'approved' ? 'selected' : '' }}>

                    Approved

                </option>

                <option
                value="rejected"
                {{ request('status') == 'rejected' ? 'selected' : '' }}>

                    Rejected

                </option>

            </select>

            <button
            class="bg-blue-600
            hover:bg-blue-700
            text-white
            px-5
            rounded-xl">

                Search

            </button>

        </form>

    </div>

    {{-- TABLE --}}

    <div
    class="bg-white
    rounded-2xl
    border border-slate-200
    overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead>

                    <tr
                    class="bg-slate-50
                    border-b">

                        <th class="px-5 py-4 text-left text-xs font-semibold uppercase text-slate-500">
                            Scholar
                        </th>

                        <th class="px-5 py-4 text-left text-xs font-semibold uppercase text-slate-500">
                            Academic Title
                        </th>

                        <th class="px-5 py-4 text-left text-xs font-semibold uppercase text-slate-500">
                            University
                        </th>

                        <th class="px-5 py-4 text-left text-xs font-semibold uppercase text-slate-500">
                            Expertise
                        </th>

                        <th class="px-5 py-4 text-center text-xs font-semibold uppercase text-slate-500">
                            Publications
                        </th>

                        <th class="px-5 py-4 text-left text-xs font-semibold uppercase text-slate-500">
                            Languages
                        </th>

                        <th class="px-5 py-4 text-left text-xs font-semibold uppercase text-slate-500">
                            Status
                        </th>

                        <th class="px-5 py-4 text-center text-xs font-semibold uppercase text-slate-500">
                            Action
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($scholars as $scholar)

                    <tr
                    class="border-b
                    hover:bg-slate-50">

                        <td class="px-5 py-4">

                            <div class="flex items-center gap-3">

                                <div
                                class="w-10 h-10
                                rounded-full
                                bg-blue-100
                                text-blue-700
                                flex items-center
                                justify-center
                                font-semibold">

                                    {{ strtoupper(substr($scholar->user->name,0,1)) }}

                                </div>

                                <div>

                                    <p class="font-medium text-slate-800">

                                        {{ $scholar->user->name }}

                                    </p>

                                    <p class="text-xs text-slate-500">

                                        {{ $scholar->user->email }}

                                    </p>

                                </div>

                            </div>

                        </td>

                        <td class="px-5 py-4">

                            {{ $scholar->academic_title }}

                        </td>

                        <td class="px-5 py-4">

                            {{ $scholar->university }}

                        </td>

                        <td class="px-5 py-4">

                            <span
                            class="px-3 py-1
                            rounded-full
                            bg-slate-100
                            text-slate-700
                            text-xs">

                                {{ $scholar->expertise }}

                            </span>

                        </td>

                        <td class="px-5 py-4 text-center">

                            <span
                            class="inline-flex
                            items-center
                            justify-center
                            w-10 h-10
                            rounded-full
                            bg-slate-100
                            font-semibold">

                                {{ $scholar->publication_count }}

                            </span>

                        </td>

                        <td class="px-5 py-4">

                            {{ $scholar->languages }}

                        </td>

                        <td class="px-5 py-4">

                            <span
                            class="px-3 py-1
                            rounded-full
                            text-xs font-medium

                            @if($scholar->verification_status == 'pending')
                                bg-orange-100 text-orange-700
                            @elseif($scholar->verification_status == 'approved')
                                bg-green-100 text-green-700
                            @else
                                bg-red-100 text-red-700
                            @endif">

                                {{ ucfirst($scholar->verification_status) }}

                            </span>

                        </td>

                        <td class="px-5 py-4 text-center">

                            <a
                            href="{{ route('admin.scholars.show', $scholar) }}"
                            class="
                            inline-flex
                            items-center
                            justify-center
                            w-9 h-9
                            rounded-lg
                            border border-slate-300
                            hover:bg-slate-100">

                                <i class="bi bi-eye"></i>

                            </a>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td
                        colspan="8"
                        class="text-center py-12 text-slate-500">

                            No scholars found.

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

    @if($scholars->hasPages())

        <div>

            {{ $scholars->links() }}

        </div>

    @endif

</div>

@endsection