@extends('layouts.app')

@section('content')

<div class="space-y-8">

    {{-- HERO --}}
    <div class="bg-gradient-to-r from-emerald-700 via-teal-700 to-cyan-700 rounded-3xl p-10 text-white">

        <div class="flex flex-col lg:flex-row justify-between gap-8">

            <div>

                <p class="uppercase tracking-widest text-cyan-100 text-sm">
                    ScholarBridge Marketplace
                </p>

                <h1 class="text-4xl font-bold mt-3">
                    Available Translation Projects
                </h1>

                <p class="mt-4 text-cyan-100 max-w-3xl">
                    Find academic translation opportunities that align with your expertise and expand your professional portfolio.
                </p>

            </div>

            <div class="grid grid-cols-2 gap-4">

                <div class="bg-white/10 backdrop-blur rounded-2xl p-6">

                    <div class="flex items-center gap-3">

                        <i class="bi bi-briefcase-fill text-2xl"></i>

                        <div>

                            <div class="text-3xl font-bold">
                                {{ number_format($totalJobs) }}
                            </div>

                            <div class="text-cyan-100 text-sm">
                                Open Projects
                            </div>

                        </div>

                    </div>

                </div>

                <div class="bg-white/10 backdrop-blur rounded-2xl p-6">

                    <div class="flex items-center gap-3">

                        <i class="bi bi-cash-stack text-2xl"></i>

                        <div>

                            <div class="text-2xl font-bold">
                                Rp {{ number_format($totalBudget,0,',','.') }}
                            </div>

                            <div class="text-cyan-100 text-sm">
                                Total Budget
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- RECOMMENDED --}}
    @if($recommendedJobs->count())

    <div class="bg-white rounded-3xl shadow-sm p-8">

        <div class="flex justify-between items-center mb-6">

            <div>

                <h2 class="text-2xl font-bold text-slate-800">
                    Recommended For You
                </h2>

                <p class="text-slate-500 mt-1">

                    Based on your expertise:

                    <span class="font-medium">
                        {{ $profile?->expertise }}
                    </span>

                </p>

            </div>

            <span class="bg-emerald-100 text-emerald-700 px-4 py-2 rounded-xl text-sm">

                {{ $recommendedJobs->count() }} Matches

            </span>

        </div>

        <div class="grid lg:grid-cols-3 gap-5">

            @foreach($recommendedJobs as $job)

                <div class="border border-slate-200 rounded-2xl p-5 hover:border-emerald-500 transition">

                    <div class="flex justify-between items-start">

                        <div>

                            <h3 class="font-bold text-slate-800">

                                {{ $job->title }}

                            </h3>

                            <p class="text-slate-500 text-sm mt-1">

                                {{ $job->field }}

                            </p>

                        </div>

                        <span class="bg-green-100 text-green-700 text-xs px-2 py-1 rounded-lg">
                            OPEN
                        </span>

                    </div>

                    <div class="mt-4 text-emerald-600 font-bold">

                        Rp {{ number_format($job->price,0,',','.') }}

                    </div>

                    <a
                        href="{{ route('translator.jobs.show',$job) }}"
                        class="mt-4 inline-flex items-center gap-2 text-emerald-600 font-medium"
                    >

                        View Project

                        <i class="bi bi-arrow-right"></i>

                    </a>

                </div>

            @endforeach

        </div>

    </div>

    @endif

    {{-- CATEGORY --}}
    @if($categories->count())

    <div class="bg-white rounded-3xl shadow-sm p-8">

        <div class="mb-6">

            <h2 class="text-2xl font-bold text-slate-800">
                Browse Categories
            </h2>

            <p class="text-slate-500 mt-1">
                Explore projects by academic discipline.
            </p>

        </div>

        <div class="grid md:grid-cols-3 xl:grid-cols-5 gap-4">

            <a
                href="{{ route('translator.jobs.index') }}"
                class="
                    border rounded-2xl p-5 text-center transition

                    {{ request('category')
                        ? 'border-slate-200'
                        : 'border-emerald-500 bg-emerald-50'
                    }}
                "
            >

                <i class="bi bi-grid-fill text-2xl text-emerald-600"></i>

                <div class="mt-3 font-semibold">
                    All
                </div>

            </a>

            @foreach($categories as $category)

                <a
                    href="{{ route('translator.jobs.index',[
                        'category' => $category
                    ]) }}"
                    class="
                        border rounded-2xl p-5 text-center transition

                        {{ request('category') == $category
                            ? 'border-emerald-500 bg-emerald-50'
                            : 'border-slate-200 hover:border-emerald-500 hover:bg-emerald-50'
                        }}
                    "
                >

                    <i class="bi bi-book-half text-2xl text-emerald-600"></i>

                    <div class="mt-3 font-semibold text-sm">

                        {{ $category }}

                    </div>

                </a>

            @endforeach

        </div>

    </div>

    @endif

    {{-- SEARCH --}}
    <div class="bg-white rounded-3xl shadow-sm p-6">

        <form method="GET">

            <div class="grid lg:grid-cols-4 gap-4">

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search title, field, language..."
                    class="border border-slate-200 rounded-xl px-4 py-3"
                >

                @if(request('category'))

                    <input
                        type="hidden"
                        name="category"
                        value="{{ request('category') }}"
                    >

                @endif

                <button
                    type="submit"
                    class="bg-emerald-600 text-white rounded-xl px-6 py-3 hover:bg-emerald-700 transition"
                >
                    <i class="bi bi-search me-2"></i>
                    Search
                </button>

                <a
                    href="{{ route('translator.jobs.index') }}"
                    class="bg-slate-100 text-slate-700 rounded-xl px-6 py-3 text-center hover:bg-slate-200 transition"
                >
                    Reset
                </a>

            </div>

        </form>

    </div>

    {{-- ALL PROJECTS --}}
    <div>

        <div class="flex justify-between items-center mb-6">

            <div>

                <h2 class="text-2xl font-bold text-slate-800">
                    All Projects
                </h2>

                <p class="text-slate-500 mt-1">
                    Open translation projects available for acceptance.
                </p>

            </div>

            <span class="text-slate-500 text-sm">

                {{ $jobs->total() }} Projects

            </span>

        </div>

        <div class="grid xl:grid-cols-2 gap-6">

            @forelse($jobs as $job)

                <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-8 hover:shadow-lg transition">

                    <div class="flex justify-between items-start gap-4">

                        <div>

                            <h3 class="text-2xl font-bold text-slate-800">

                                {{ $job->title }}

                            </h3>

                            <p class="text-slate-500 mt-2">

                                {{ $job->field }}

                            </p>

                        </div>

                        <span class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm font-semibold">

                            OPEN

                        </span>

                    </div>

                    <p class="text-slate-600 mt-5">

                        {{ \Illuminate\Support\Str::limit($job->description,150) }}

                    </p>

                    <div class="grid grid-cols-2 gap-5 mt-6">

                        <div>

                            <div class="text-xs text-slate-400 uppercase">
                                Client
                            </div>

                            <div class="font-medium mt-1">
                                {{ $job->user?->name }}
                            </div>

                        </div>

                        <div>

                            <div class="text-xs text-slate-400 uppercase">
                                Service
                            </div>

                            <div class="font-medium mt-1">
                                {{ $job->service?->name }}
                            </div>

                        </div>

                        <div>

                            <div class="text-xs text-slate-400 uppercase">
                                Source
                            </div>

                            <div class="font-medium mt-1">
                                {{ $job->source_language }}
                            </div>

                        </div>

                        <div>

                            <div class="text-xs text-slate-400 uppercase">
                                Target
                            </div>

                            <div class="font-medium mt-1">
                                {{ $job->target_language }}
                            </div>

                        </div>

                    </div>

                    <div class="mt-6 flex justify-between items-center">

                        <div>

                            <div class="text-xs text-slate-400 uppercase">
                                Budget
                            </div>

                            <div class="text-2xl font-bold text-emerald-600">

                                Rp {{ number_format($job->price,0,',','.') }}

                            </div>

                        </div>

                        <div class="text-right text-sm text-slate-500">

                            {{ $job->created_at->format('d M Y') }}

                        </div>

                    </div>

                    <div class="grid grid-cols-2 gap-3 mt-8">

                        <a
                            href="{{ route('translator.jobs.show',$job) }}"
                            class="text-center bg-slate-100 text-slate-700 py-3 rounded-xl hover:bg-slate-200 transition"
                        >
                            <i class="bi bi-eye"></i>
                            Detail
                        </a>

                        <form
                            action="{{ route('translator.jobs.accept',$job) }}"
                            method="POST"
                        >
                            @csrf
                            @method('PATCH')

                            <button
                                type="submit"
                                class="w-full bg-emerald-600 text-white py-3 rounded-xl hover:bg-emerald-700 transition"
                            >
                                <i class="bi bi-check-circle"></i>
                                Accept
                            </button>

                        </form>

                    </div>

                </div>

            @empty

                <div class="col-span-full">

                    <div class="bg-white rounded-3xl shadow-sm p-16 text-center">

                        <i class="bi bi-folder2-open text-6xl text-slate-300"></i>

                        <h2 class="text-3xl font-bold text-slate-700 mt-6">
                            No Available Projects
                        </h2>

                        <p class="text-slate-500 mt-2">
                            There are currently no open projects available.
                        </p>

                    </div>

                </div>

            @endforelse

        </div>

    </div>

    @if($jobs->hasPages())

        <div class="bg-white rounded-2xl shadow-sm p-6">

            {{ $jobs->links() }}

        </div>

    @endif

</div>

@endsection