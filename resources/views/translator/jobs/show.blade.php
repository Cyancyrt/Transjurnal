@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto space-y-8">

    {{-- Hero --}}
    <div class="bg-gradient-to-r from-emerald-700 via-teal-700 to-cyan-700 rounded-3xl p-10 text-white">

        <div class="flex flex-col lg:flex-row justify-between gap-8">

            <div>

                <p class="uppercase tracking-widest text-cyan-100 text-sm">
                    Available Translation Project
                </p>

                <h1 class="text-4xl font-bold mt-3">

                    {{ $job->title }}

                </h1>

                <p class="mt-4 text-cyan-100">

                    {{ $job->field }}

                </p>

            </div>

            <div>

                <span class="bg-white/20 backdrop-blur px-5 py-3 rounded-xl font-semibold">

                    OPEN

                </span>

            </div>

        </div>

    </div>

    <div class="grid lg:grid-cols-3 gap-8">

        {{-- Main Content --}}
        <div class="lg:col-span-2 space-y-8">

            {{-- Project Description --}}
            <div class="bg-white rounded-3xl shadow-sm p-8">

                <h2 class="text-2xl font-bold text-slate-800 mb-6">

                    Project Description

                </h2>

                <div class="prose max-w-none text-slate-600">

                    {!! nl2br(e($job->description)) !!}

                </div>

            </div>

            {{-- Translation Information --}}
            <div class="bg-white rounded-3xl shadow-sm p-8">

                <h2 class="text-2xl font-bold text-slate-800 mb-6">

                    Translation Information

                </h2>

                <div class="grid md:grid-cols-2 gap-6">

                    <div>

                        <p class="text-sm text-slate-500">
                            Academic Field
                        </p>

                        <p class="font-semibold mt-2">
                            {{ $job->field }}
                        </p>

                    </div>

                    <div>

                        <p class="text-sm text-slate-500">
                            Service Type
                        </p>

                        <p class="font-semibold mt-2">
                            {{ $job->service?->name }}
                        </p>

                    </div>

                    <div>

                        <p class="text-sm text-slate-500">
                            Source Language
                        </p>

                        <p class="font-semibold mt-2">
                            {{ $job->source_language }}
                        </p>

                    </div>

                    <div>

                        <p class="text-sm text-slate-500">
                            Target Language
                        </p>

                        <p class="font-semibold mt-2">
                            {{ $job->target_language }}
                        </p>

                    </div>

                </div>

            </div>

            {{-- Journal File --}}
            <div class="bg-white rounded-3xl shadow-sm p-8">

                <h2 class="text-2xl font-bold text-slate-800 mb-6">

                    Journal File

                </h2>

                <div class="border border-slate-200 rounded-2xl p-6 flex flex-col md:flex-row items-center justify-between gap-4">

                    <div class="flex items-center gap-4">

                        <div class="w-14 h-14 rounded-xl bg-red-100 flex items-center justify-center">

                            <i class="bi bi-file-earmark-pdf-fill text-red-600 text-2xl"></i>

                        </div>

                        <div>

                            <h3 class="font-semibold text-slate-800">
                                Original Journal
                            </h3>

                            <p class="text-sm text-slate-500">
                                Download and review before accepting.
                            </p>

                        </div>

                    </div>

                    <a
                        href="{{ asset('storage/'.$job->journal_file) }}"
                        target="_blank"
                        class="bg-red-600 text-white px-5 py-3 rounded-xl hover:bg-red-700 transition"
                    >

                        <i class="bi bi-download me-2"></i>
                        Download File

                    </a>

                </div>

            </div>

            {{-- Client Information --}}
            <div class="bg-white rounded-3xl shadow-sm p-8">

                <h2 class="text-2xl font-bold text-slate-800 mb-6">

                    Client Information

                </h2>

                <div class="flex items-center gap-5">

                    <div class="w-16 h-16 rounded-full bg-slate-200 flex items-center justify-center">

                        <i class="bi bi-person-fill text-2xl text-slate-600"></i>

                    </div>

                    <div>

                        <h3 class="font-semibold text-lg">

                            {{ $job->user?->name }}

                        </h3>

                        <p class="text-slate-500">

                            Project Owner

                        </p>

                    </div>

                </div>

            </div>

        </div>

        {{-- Sidebar --}}
        <div>

            <div class="bg-white rounded-3xl shadow-sm p-8 sticky top-8">

                <h2 class="text-xl font-bold text-slate-800 mb-6">

                    Project Summary

                </h2>

                <div class="space-y-5">

                    <div>

                        <p class="text-sm text-slate-500">
                            Budget
                        </p>

                        <p class="text-3xl font-bold text-emerald-600 mt-1">

                            Rp {{ number_format($job->price,0,',','.') }}

                        </p>

                    </div>

                    <hr>

                    <div>

                        <p class="text-sm text-slate-500">
                            Status
                        </p>

                        <span class="inline-flex mt-2 bg-green-100 text-green-700 px-3 py-2 rounded-xl text-sm font-semibold">

                            OPEN

                        </span>

                    </div>

                    <hr>

                    <div>

                        <p class="text-sm text-slate-500">
                            Posted
                        </p>

                        <p class="font-medium mt-2">

                            {{ $job->created_at->format('d M Y') }}

                        </p>

                    </div>

                    <hr>

                    <div>

                        <p class="text-sm text-slate-500">
                            Languages
                        </p>

                        <p class="font-medium mt-2">

                            {{ $job->source_language }}

                            →

                            {{ $job->target_language }}

                        </p>

                    </div>

                </div>

                <form
                    action="{{ route('translator.jobs.accept',$job) }}"
                    method="POST"
                    class="mt-8"
                >

                    @csrf
                    @method('PATCH')

                    <button
                        type="submit"
                        class="w-full bg-emerald-600 text-white py-4 rounded-xl hover:bg-emerald-700 transition font-semibold"
                    >

                        <i class="bi bi-check-circle me-2"></i>

                        Accept This Project

                    </button>

                </form>

                <a
                    href="{{ route('translator.jobs.index') }}"
                    class="block text-center mt-4 bg-slate-100 text-slate-700 py-4 rounded-xl hover:bg-slate-200 transition"
                >

                    Back to Jobs

                </a>

            </div>

        </div>

    </div>

</div>

@endsection