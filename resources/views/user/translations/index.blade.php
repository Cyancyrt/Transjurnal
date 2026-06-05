@extends('layouts.app')

@section('content')

<div class="space-y-8">

    {{-- Hero --}}
    <div class="bg-gradient-to-r from-green-600 to-emerald-600 rounded-3xl p-10 text-white">

        <h1 class="text-4xl font-bold">
            Completed Translations
        </h1>

        <p class="mt-3 text-green-100">
            Access and download all completed translation projects.
        </p>

    </div>

    {{-- Stats --}}
    <div class="grid md:grid-cols-3 gap-6">

        <div class="bg-white rounded-2xl shadow-sm p-6">

            <p class="text-slate-500 text-sm">
                Completed Projects
            </p>

            <h2 class="text-3xl font-bold mt-2">

                {{ $translations->total() }}

            </h2>

        </div>

        <div class="bg-white rounded-2xl shadow-sm p-6">

            <p class="text-slate-500 text-sm">
                Available Downloads
            </p>

            <h2 class="text-3xl font-bold mt-2">

                {{ $translations->whereNotNull('translated_file')->count() }}

            </h2>

        </div>

        <div class="bg-white rounded-2xl shadow-sm p-6">

            <p class="text-slate-500 text-sm">
                Latest Completion
            </p>

            <h2 class="text-lg font-bold mt-2">

                @if($translations->count())

                    {{ $translations->first()->updated_at->format('d M Y') }}

                @else

                    -

                @endif

            </h2>

        </div>

    </div>

    {{-- Translation Cards --}}
    <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-6">

        @forelse($translations as $translation)

            <div class="bg-white rounded-3xl shadow-sm overflow-hidden border border-slate-200">

                <div class="bg-green-600 p-5">

                    <div class="flex justify-between items-center">

                        <h2 class="text-white font-bold text-lg">

                            Completed

                        </h2>

                        <i class="bi bi-check-circle-fill text-white text-xl"></i>

                    </div>

                </div>

                <div class="p-6">

                    <h3 class="font-bold text-xl">

                        {{ $translation->title }}

                    </h3>

                    <p class="text-slate-500 mt-2">

                        {{ $translation->field }}

                    </p>

                    <div class="mt-6 space-y-4">

                        <div class="flex justify-between">

                            <span class="text-slate-500">
                                Translator
                            </span>

                            <span class="font-medium">

                                {{ $translation->translator?->name ?? 'N/A' }}

                            </span>

                        </div>

                        <div class="flex justify-between">

                            <span class="text-slate-500">
                                Service
                            </span>

                            <span class="font-medium">

                                {{ $translation->service?->name }}

                            </span>

                        </div>

                        <div class="flex justify-between">

                            <span class="text-slate-500">
                                Completed
                            </span>

                            <span class="font-medium">

                                {{ $translation->updated_at->format('d M Y') }}

                            </span>

                        </div>

                        <div class="flex justify-between">

                            <span class="text-slate-500">
                                Price
                            </span>

                            <span class="font-medium">

                                Rp {{ number_format($translation->price,0,',','.') }}

                            </span>

                        </div>

                    </div>

                    <div class="mt-8 flex gap-3">

                        <a
                            href="{{ route('user.orders.show', $translation) }}"
                            class="flex-1 text-center bg-slate-900 text-white py-3 rounded-xl"
                        >
                            View Detail
                        </a>

                        @if($translation->translated_file)

                            <a
                                href="{{ asset('storage/' . $translation->translated_file) }}"
                                target="_blank"
                                class="px-4 py-3 bg-green-600 text-white rounded-xl"
                            >
                                <i class="bi bi-download"></i>
                            </a>

                        @endif

                    </div>

                </div>

            </div>

        @empty

            <div class="col-span-full">

                <div class="bg-white rounded-3xl p-16 text-center shadow-sm">

                    <i class="bi bi-folder2-open text-6xl text-slate-300"></i>

                    <h2 class="text-2xl font-bold mt-6">
                        No Completed Translations
                    </h2>

                    <p class="text-slate-500 mt-2">
                        You don't have any completed translation projects yet.
                    </p>

                    <a
                        href="{{ route('user.orders.create') }}"
                        class="inline-block mt-6 px-6 py-3 bg-indigo-600 text-white rounded-xl"
                    >
                        Create New Order
                    </a>

                </div>

            </div>

        @endforelse

    </div>

    <div>

        {{ $translations->links() }}

    </div>

</div>

@endsection