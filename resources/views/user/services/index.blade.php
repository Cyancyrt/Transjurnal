@extends('layouts.app')

@section('content')

<div class="space-y-8">

    {{-- Header --}}
    <div class="bg-gradient-to-r from-indigo-600 to-blue-600 rounded-3xl p-10 text-white">

        <h1 class="text-4xl font-bold">
            Translation Services
        </h1>

        <p class="mt-3 text-indigo-100 text-lg">
            Choose the translation service that best matches your academic needs.
        </p>

    </div>

    {{-- Services Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">

        @forelse($services as $service)

            <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden hover:shadow-lg transition">

                <div class="bg-slate-900 p-6">

                    <h2 class="text-2xl font-bold text-white">

                        {{ $service->name }}

                    </h2>

                </div>

                <div class="p-6">

                    <div class="mb-6">

                        <p class="text-slate-600 leading-7">

                            {{ $service->description }}

                        </p>

                    </div>

                    <div class="border-t pt-6">

                        <p class="text-sm text-slate-500">
                            Starting From
                        </p>

                        <h3 class="text-4xl font-bold text-indigo-600 mt-2">

                            Rp {{ number_format($service->base_price,0,',','.') }}

                        </h3>

                    </div>

                    <div class="mt-8">

                        <a
                            href="{{ route('user.orders.create', ['service' => $service->id]) }}"
                            class="block text-center bg-indigo-600 text-white py-3 rounded-xl font-semibold hover:bg-indigo-700 transition"
                        >
                            Select Service
                        </a>

                    </div>

                </div>

            </div>

        @empty

            <div class="col-span-full">

                <div class="bg-white rounded-3xl p-16 text-center shadow-sm">

                    <i class="bi bi-briefcase text-6xl text-slate-300"></i>

                    <h2 class="text-2xl font-bold mt-6">
                        No Services Available
                    </h2>

                    <p class="text-slate-500 mt-2">
                        There are currently no translation services available.
                    </p>

                </div>

            </div>

        @endforelse

    </div>

    {{-- Why Choose ScholarBridge --}}
    <div class="bg-white rounded-3xl p-8 shadow-sm">

        <h2 class="text-2xl font-bold mb-8">
            Why Choose ScholarBridge?
        </h2>

        <div class="grid md:grid-cols-3 gap-6">

            <div class="p-6 rounded-2xl bg-slate-50">

                <div class="w-12 h-12 rounded-xl bg-indigo-100 flex items-center justify-center">

                    <i class="bi bi-patch-check-fill text-indigo-600 text-xl"></i>

                </div>

                <h3 class="font-bold text-lg mt-4">
                    Verified Scholars
                </h3>

                <p class="text-slate-600 mt-2">
                    Work with qualified academic translators from trusted universities.
                </p>

            </div>

            <div class="p-6 rounded-2xl bg-slate-50">

                <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center">

                    <i class="bi bi-journal-richtext text-green-600 text-xl"></i>

                </div>

                <h3 class="font-bold text-lg mt-4">
                    Academic Focus
                </h3>

                <p class="text-slate-600 mt-2">
                    Specialized translation for journals, theses, and research papers.
                </p>

            </div>

            <div class="p-6 rounded-2xl bg-slate-50">

                <div class="w-12 h-12 rounded-xl bg-yellow-100 flex items-center justify-center">

                    <i class="bi bi-lightning-charge-fill text-yellow-600 text-xl"></i>

                </div>

                <h3 class="font-bold text-lg mt-4">
                    Fast Delivery
                </h3>

                <p class="text-slate-600 mt-2">
                    Receive professional translation results within the agreed timeframe.
                </p>

            </div>

        </div>

    </div>

</div>

@endsection