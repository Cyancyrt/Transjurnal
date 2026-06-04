@extends('layouts.admin')

@section('page-title', 'Scholar Detail')

@section('content')

<div class="space-y-6">

    {{-- HEADER --}}

    <div
    class="bg-white
    border border-slate-200
    rounded-2xl
    p-6">

        <div class="flex items-start justify-between">

            <div class="flex items-center gap-4">

                <div
                class="w-16 h-16
                rounded-full
                bg-blue-100
                text-blue-700
                flex items-center
                justify-center
                text-2xl
                font-bold">

                    {{ strtoupper(substr($scholar->user->name,0,1)) }}

                </div>

                <div>

                    <h1
                    class="text-2xl font-bold
                    text-slate-800">

                        {{ $scholar->user->name }}

                    </h1>

                    <p class="text-slate-500 mt-1">

                        {{ $scholar->academic_title }}

                    </p>

                    <p class="text-sm text-slate-400">

                        {{ $scholar->user->email }}

                    </p>

                </div>

            </div>

            <div>

                <span
                class="px-4 py-2 rounded-full text-sm font-medium

                @if($scholar->verification_status == 'pending')
                    bg-orange-100 text-orange-700
                @elseif($scholar->verification_status == 'approved')
                    bg-green-100 text-green-700
                @else
                    bg-red-100 text-red-700
                @endif">

                    {{ ucfirst($scholar->verification_status) }}

                </span>

            </div>

        </div>

    </div>

    {{-- STATS --}}

    <div class="grid md:grid-cols-3 gap-4">

        <div
        class="bg-white
        border border-slate-200
        rounded-2xl
        p-5">

            <p class="text-xs uppercase text-slate-500">

                Publications

            </p>

            <h2
            class="text-3xl font-bold
            mt-2">

                {{ $scholar->publication_count }}

            </h2>

        </div>

        <div
        class="bg-white
        border border-slate-200
        rounded-2xl
        p-5">

            <p class="text-xs uppercase text-slate-500">

                Hourly Rate

            </p>

            <h2
            class="text-3xl font-bold
            text-green-600 mt-2">

                Rp {{ number_format($scholar->hourly_rate) }}

            </h2>

        </div>

        <div
        class="bg-white
        border border-slate-200
        rounded-2xl
        p-5">

            <p class="text-xs uppercase text-slate-500">

                Languages

            </p>

            <h2
            class="text-lg font-semibold
            mt-2">

                {{ $scholar->languages }}

            </h2>

        </div>

    </div>

    {{-- CONTENT --}}

    <div class="grid lg:grid-cols-3 gap-6">

        {{-- LEFT --}}

        <div class="lg:col-span-2 space-y-6">

            {{-- BIO --}}

            <div
            class="bg-white
            border border-slate-200
            rounded-2xl
            p-6">

                <h3
                class="font-semibold
                text-slate-800 mb-4">

                    Biography

                </h3>

                <p
                class="text-slate-600
                leading-relaxed">

                    {{ $scholar->bio }}

                </p>

            </div>

            {{-- EXPERTISE --}}

            <div
            class="bg-white
            border border-slate-200
            rounded-2xl
            p-6">

                <h3
                class="font-semibold
                text-slate-800 mb-4">

                    Academic Expertise

                </h3>

                <span
                class="inline-flex
                px-4 py-2
                rounded-full
                bg-blue-100
                text-blue-700
                font-medium">

                    {{ $scholar->expertise }}

                </span>

            </div>

        </div>

        {{-- RIGHT --}}

        <div class="space-y-6">

            {{-- UNIVERSITY --}}

            <div
            class="bg-white
            border border-slate-200
            rounded-2xl
            p-6">

                <h3
                class="font-semibold mb-4">

                    University

                </h3>

                <p>

                    {{ $scholar->university }}

                </p>

            </div>

            {{-- ACCOUNT INFO --}}

            <div
            class="bg-white
            border border-slate-200
            rounded-2xl
            p-6">

                <h3
                class="font-semibold mb-4">

                    Account Information

                </h3>

                <div class="space-y-4">

                    <div>

                        <p class="text-xs text-slate-400">

                            Name

                        </p>

                        <p>

                            {{ $scholar->user->name }}

                        </p>

                    </div>

                    <div>

                        <p class="text-xs text-slate-400">

                            Email

                        </p>

                        <p>

                            {{ $scholar->user->email }}

                        </p>

                    </div>

                    <div>

                        <p class="text-xs text-slate-400">

                            Role

                        </p>

                        <p>

                            Translator
                        </p>

                    </div>

                </div>

            </div>

            {{-- VERIFICATION ACTIONS --}}

            @if($scholar->verification_status == 'pending')

            <div
            class="bg-white
            border border-slate-200
            rounded-2xl
            p-6">

                <h3
                class="font-semibold mb-4">

                    Verification

                </h3>

                <div class="flex gap-3">

                    <form
                    method="POST"
                    action="{{ route('admin.scholars.approve', $scholar) }}">

                        @csrf

                        <button
                        class="bg-green-600
                        hover:bg-green-700
                        text-white
                        px-5 py-2
                        rounded-lg">

                            Approve

                        </button>

                    </form>

                    <form
                    method="POST"
                    action="{{ route('admin.scholars.reject', $scholar) }}">

                        @csrf

                        <button
                        class="bg-red-600
                        hover:bg-red-700
                        text-white
                        px-5 py-2
                        rounded-lg">

                            Reject

                        </button>

                    </form>

                </div>

            </div>

            @endif

        </div>

    </div>

</div>

@endsection