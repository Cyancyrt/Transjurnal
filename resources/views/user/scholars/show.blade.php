@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto space-y-8">

    {{-- Cover --}}
    <div class="bg-gradient-to-r from-indigo-700 to-blue-700 rounded-3xl overflow-hidden">

        <div class="p-10">

            <div class="flex flex-col lg:flex-row lg:items-center gap-8">

                <div
                    class="w-36 h-36 rounded-full bg-white/20 border-4 border-white">
                </div>

                <div class="text-white">

                    <h1 class="text-4xl font-bold">

                        {{ $translatorProfile->academic_title }}

                        {{ $translatorProfile->user->name ?? 'Unknown Scholar' }}

                    </h1>

                    <p class="mt-2 text-indigo-100 text-lg">

                        {{ $translatorProfile->university }}

                    </p>

                    <div class="flex flex-wrap gap-3 mt-5">

                        <span class="px-4 py-2 rounded-full bg-white/20">

                            {{ $translatorProfile->expertise }}

                        </span>

                        <span class="px-4 py-2 rounded-full bg-white/20">

                            {{ ucfirst($translatorProfile->verification_status) }}

                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- Stats --}}
    <div class="grid md:grid-cols-3 gap-6">

        <div class="bg-white rounded-2xl p-6 shadow-sm">

            <div class="flex items-center gap-3">

                <i class="bi bi-journal-richtext text-2xl text-indigo-600"></i>

                <div>

                    <p class="text-slate-500 text-sm">
                        Publications
                    </p>

                    <h2 class="text-3xl font-bold">

                        {{ $translatorProfile->publication_count }}

                    </h2>

                </div>

            </div>

        </div>

        <div class="bg-white rounded-2xl p-6 shadow-sm">

            <div class="flex items-center gap-3">

                <i class="bi bi-cash-stack text-2xl text-green-600"></i>

                <div>

                    <p class="text-slate-500 text-sm">
                        Hourly Rate
                    </p>

                    <h2 class="text-3xl font-bold">

                        Rp {{ number_format($translatorProfile->hourly_rate,0,',','.') }}

                    </h2>

                </div>

            </div>

        </div>

        <div class="bg-white rounded-2xl p-6 shadow-sm">

            <div class="flex items-center gap-3">

                <i class="bi bi-patch-check-fill text-2xl text-blue-600"></i>

                <div>

                    <p class="text-slate-500 text-sm">
                        Verification
                    </p>

                    <h2 class="text-3xl font-bold">

                        {{ ucfirst($translatorProfile->verification_status) }}

                    </h2>

                </div>

            </div>

        </div>

    </div>

    {{-- Main Content --}}
    <div class="grid lg:grid-cols-3 gap-8">

        {{-- Left --}}
        <div class="lg:col-span-2 space-y-8">

            {{-- About --}}
            <div class="bg-white rounded-2xl shadow-sm p-8">

                <h2 class="text-2xl font-bold mb-5">
                    About Scholar
                </h2>

                <p class="leading-8 text-slate-600">

                    {{ $translatorProfile->bio }}

                </p>

            </div>

            {{-- Expertise --}}
            <div class="bg-white rounded-2xl shadow-sm p-8">

                <h2 class="text-2xl font-bold mb-5">
                    Expertise
                </h2>

                <div class="flex flex-wrap gap-3">

                    @foreach(explode(',', $translatorProfile->expertise) as $skill)

                        <span
                            class="px-4 py-2 bg-indigo-100 text-indigo-700 rounded-full">

                            {{ trim($skill) }}

                        </span>

                    @endforeach

                </div>

            </div>

            {{-- Languages --}}
            <div class="bg-white rounded-2xl shadow-sm p-8">

                <h2 class="text-2xl font-bold mb-5">
                    Languages
                </h2>

                <div class="flex flex-wrap gap-3">

                    @foreach(explode(',', $translatorProfile->languages) as $language)

                        <span
                            class="px-4 py-2 bg-green-100 text-green-700 rounded-full">

                            {{ trim($language) }}

                        </span>

                    @endforeach

                </div>

            </div>

        </div>

        {{-- Right --}}
        <div>

            <div class="bg-white rounded-2xl shadow-sm p-8 sticky top-8">

                <h2 class="text-xl font-bold mb-5">

                    Scholar Information

                </h2>

                <div class="space-y-5">

                    <div>

                        <p class="text-sm text-slate-500">
                            Academic Title
                        </p>

                        <p class="font-semibold">
                            {{ $translatorProfile->academic_title }}
                        </p>

                    </div>

                    <div>

                        <p class="text-sm text-slate-500">
                            University
                        </p>

                        <p class="font-semibold">
                            {{ $translatorProfile->university }}
                        </p>

                    </div>

                    <div>

                        <p class="text-sm text-slate-500">
                            Publications
                        </p>

                        <p class="font-semibold">
                            {{ $translatorProfile->publication_count }}
                        </p>

                    </div>

                    <div>

                        <p class="text-sm text-slate-500">
                            Hourly Rate
                        </p>

                        <p class="font-semibold">

                            Rp {{ number_format($translatorProfile->hourly_rate,0,',','.') }}

                        </p>

                    </div>

                </div>

                <button
                    class="w-full mt-8 py-3 bg-indigo-600 text-white rounded-xl font-semibold">

                    Hire Scholar

                </button>

            </div>

        </div>

    </div>

</div>

@endsection