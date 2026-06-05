@extends('layouts.app')

@section('content')

<div class="space-y-8">

    {{-- Header --}}
    <div class="bg-white rounded-3xl p-8 shadow-sm">

        <h1 class="text-3xl font-bold">
            Browse Scholars
        </h1>

        <p class="text-slate-500 mt-2">
            Find verified academic translators for your journal translation projects.
        </p>

    </div>

    {{-- Search --}}
    <div class="bg-white rounded-3xl p-6 shadow-sm">

        <form method="GET">

            <div class="grid md:grid-cols-3 gap-4">

                <div>

                    <label class="block text-sm mb-2">
                        Search Scholar
                    </label>

                    <input
                        type="text"
                        name="search"
                        placeholder="Artificial Intelligence"
                        class="w-full border rounded-xl px-4 py-3"
                    >

                </div>

                <div>

                    <label class="block text-sm mb-2">
                        University
                    </label>

                    <input
                        type="text"
                        name="university"
                        placeholder="Universitas Indonesia"
                        class="w-full border rounded-xl px-4 py-3"
                    >

                </div>

                <div class="flex items-end">

                    <button
                        class="w-full bg-indigo-600 text-white py-3 rounded-xl"
                    >
                        Search
                    </button>

                </div>

            </div>

        </form>

    </div>

    {{-- Scholars --}}
    <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-6">

        @forelse($scholars as $scholar)

            <div class="bg-white rounded-3xl shadow-sm overflow-hidden">

                <div class="h-28 bg-gradient-to-r from-indigo-600 to-blue-600">
                </div>

                <div class="px-6 pb-6">

                    <div class="w-24 h-24 rounded-full bg-slate-200 border-4 border-white -mt-12">
                    </div>

                    <div class="mt-4">

                        <h2 class="text-xl font-bold">

                            {{ $scholar->academic_title }}

                            {{ $scholar->user->name }}

                        </h2>

                        <p class="text-slate-500 mt-1">

                            {{ $scholar->university }}

                        </p>

                    </div>

                    <div class="mt-4">

                        <span class="inline-flex px-3 py-1 rounded-full text-sm bg-indigo-100 text-indigo-700">

                            {{ $scholar->expertise }}

                        </span>

                    </div>

                    <div class="grid grid-cols-2 gap-4 mt-6">

                        <div class="bg-slate-50 rounded-xl p-4">

                            <p class="text-xs text-slate-500">
                                Publications
                            </p>

                            <p class="font-bold text-lg">
                                {{ $scholar->publication_count }}
                            </p>

                        </div>

                        <div class="bg-slate-50 rounded-xl p-4">

                            <p class="text-xs text-slate-500">
                                Rate
                            </p>

                            <p class="font-bold text-lg">
                                Rp {{ number_format($scholar->hourly_rate,0,',','.') }}
                            </p>

                        </div>

                    </div>

                    <div class="mt-5">

                        <p class="text-sm text-slate-600 line-clamp-3">

                            {{ $scholar->bio }}

                        </p>

                    </div>

                    <div class="mt-6 flex gap-3">

                        <a
                            href="{{ route('user.scholars.show', $scholar) }}"
                            class="flex-1 text-center bg-indigo-600 text-white py-3 rounded-xl"
                        >
                            View Profile
                        </a>

                        <button
                            class="px-4 bg-slate-100 rounded-xl"
                        >
                            <i class="bi bi-bookmark"></i>
                        </button>

                    </div>

                </div>

            </div>

        @empty

            <div class="col-span-full">

                <div class="bg-white rounded-3xl p-12 text-center">

                    <i class="bi bi-mortarboard text-5xl text-slate-400"></i>

                    <h2 class="mt-4 text-xl font-semibold">
                        No Scholars Found
                    </h2>

                    <p class="text-slate-500 mt-2">
                        There are currently no verified scholars available.
                    </p>

                </div>

            </div>

        @endforelse

    </div>

    <div>

        {{ $scholars->links() }}

    </div>

</div>

@endsection