@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto space-y-8">

    {{-- Hero --}}
    <div class="bg-gradient-to-r from-slate-900 via-indigo-900 to-blue-900 rounded-3xl p-10 text-white">

        <div class="flex flex-col lg:flex-row items-center lg:items-start gap-8">

            <div>

                @if($user->avatar)

                    <img
                        src="{{ asset('storage/'.$user->avatar) }}"
                        alt="Avatar"
                        class="w-32 h-32 rounded-full object-cover border-4 border-white/20"
                    >

                @else

                    <div
                        class="w-32 h-32 rounded-full bg-white/10 backdrop-blur flex items-center justify-center text-5xl"
                    >
                        <i class="bi bi-person-fill"></i>
                    </div>

                @endif

            </div>

            <div class="flex-1">

                <p class="uppercase tracking-widest text-indigo-200 text-sm">
                    Academic Translator
                </p>

                <h1 class="text-4xl font-bold mt-3">

                    {{ $user->academic_title ?? '' }}
                    {{ $user->name }}

                </h1>

                <p class="mt-3 text-indigo-200">

                    {{ $user->university ?? 'University not specified' }}

                </p>

                <div class="mt-5 flex flex-wrap gap-3">

                    <span class="bg-white/10 px-4 py-2 rounded-xl text-sm">

                        {{ $user->expertise ?? 'No Expertise' }}

                    </span>

                    <span class="bg-green-500 px-4 py-2 rounded-xl text-sm">

                        {{ ucfirst($user->verification_status ?? 'verified') }}

                    </span>

                </div>

            </div>

            <div>

                <a
                    href="{{ route('translator.profile.edit',$user->id) }}"
                    class="inline-flex items-center gap-2 bg-white text-slate-900 px-6 py-3 rounded-xl font-semibold hover:bg-slate-100"
                >
                    <i class="bi bi-pencil-square"></i>
                    Edit Profile
                </a>

            </div>

        </div>

    </div>

    {{-- Statistics --}}
    <div class="grid md:grid-cols-3 gap-6">

        <div class="bg-white rounded-2xl shadow-sm p-6">

            <p class="text-slate-500 text-sm">
                Publications
            </p>

            <h2 class="text-3xl font-bold mt-2">

                {{ $user->publication_count ?? 0 }}

            </h2>

        </div>

        <div class="bg-white rounded-2xl shadow-sm p-6">

            <p class="text-slate-500 text-sm">
                Hourly Rate
            </p>

            <h2 class="text-3xl font-bold mt-2 text-green-600">

                Rp {{ number_format($user->hourly_rate ?? 0,0,',','.') }}

            </h2>

        </div>

        <div class="bg-white rounded-2xl shadow-sm p-6">

            <p class="text-slate-500 text-sm">
                Account Status
            </p>

            <h2 class="text-3xl font-bold mt-2 text-blue-600">

                {{ ucfirst($user->verification_status ?? 'verified') }}

            </h2>

        </div>

    </div>

    {{-- Main Content --}}
    <div class="grid lg:grid-cols-3 gap-8">

        {{-- Left --}}
        <div class="lg:col-span-2 space-y-8">

            <div class="bg-white rounded-2xl shadow-sm p-8">

                <h2 class="text-2xl font-bold mb-6">
                    Academic Information
                </h2>

                <div class="grid md:grid-cols-2 gap-6">

                    <div>

                        <p class="text-sm text-slate-500">
                            Full Name
                        </p>

                        <p class="font-semibold mt-2">
                            {{ $user->name }}
                        </p>

                    </div>

                    <div>

                        <p class="text-sm text-slate-500">
                            Academic Title
                        </p>

                        <p class="font-semibold mt-2">
                            {{ $user->academic_title ?? '-' }}
                        </p>

                    </div>

                    <div>

                        <p class="text-sm text-slate-500">
                            University
                        </p>

                        <p class="font-semibold mt-2">
                            {{ $user->university ?? '-' }}
                        </p>

                    </div>

                    <div>

                        <p class="text-sm text-slate-500">
                            Expertise
                        </p>

                        <p class="font-semibold mt-2">
                            {{ $user->expertise ?? '-' }}
                        </p>

                    </div>

                </div>

            </div>

            <div class="bg-white rounded-2xl shadow-sm p-8">

                <h2 class="text-2xl font-bold mb-6">
                    Contact Information
                </h2>

                <div class="space-y-6">

                    <div>

                        <p class="text-sm text-slate-500">
                            Email
                        </p>

                        <p class="font-semibold mt-2">
                            {{ $user->email }}
                        </p>

                    </div>

                </div>

            </div>

        </div>

        {{-- Right --}}
        <div>

            <div class="bg-white rounded-2xl shadow-sm p-8 sticky top-8">

                <h2 class="text-xl font-bold mb-6">
                    Profile Completion
                </h2>

                @php

                    $completion = 0;

                    if($user->academic_title) $completion += 20;
                    if($user->university) $completion += 20;
                    if($user->expertise) $completion += 20;
                    if($user->publication_count) $completion += 20;
                    if($user->hourly_rate) $completion += 20;

                @endphp

                <div class="mb-4">

                    <div class="flex justify-between mb-2">

                        <span class="text-sm text-slate-500">
                            Completion
                        </span>

                        <span class="font-semibold">
                            {{ $completion }}%
                        </span>

                    </div>

                    <div class="w-full bg-slate-200 rounded-full h-3">

                        <div
                            class="bg-indigo-600 h-3 rounded-full"
                            style="width: {{ $completion }}%"
                        ></div>

                    </div>

                </div>

                <div class="mt-8">

                    <a
                        href="{{ route('translator.profile.edit',$user->id) }}"
                        class="block text-center bg-indigo-600 text-white py-3 rounded-xl hover:bg-indigo-700"
                    >
                        Update Profile
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection