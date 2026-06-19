@extends('layouts.app')

@section('content')

<div class="max-w-5xl mx-auto space-y-8">

    {{-- Header --}}
    <div class="bg-gradient-to-r from-indigo-700 to-blue-700 rounded-3xl p-10 text-white">

        <p class="uppercase tracking-widest text-indigo-100 text-sm">
            Translator Profile
        </p>

        <h1 class="text-4xl font-bold mt-3">
            Edit Profile
        </h1>

        <p class="mt-3 text-indigo-100">
            Keep your academic profile updated to attract more clients.
        </p>

    </div>

    @if(session('success'))

        <div class="bg-green-100 border border-green-200 text-green-700 px-5 py-4 rounded-2xl">

            {{ session('success') }}

        </div>

    @endif

    @if($errors->any())

        <div class="bg-red-100 border border-red-200 text-red-700 px-5 py-4 rounded-2xl">

            <ul class="list-disc ml-5">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <form
        action="{{ route('translator.profile.update', auth()->id()) }}"
        method="POST"
    >

        @csrf
        @method('PUT')

        <div class="grid lg:grid-cols-2 gap-8">

            {{-- Left --}}
            <div class="space-y-6">

                <div class="bg-white rounded-2xl shadow-sm p-8">

                    <h2 class="text-xl font-bold mb-6">
                        Personal Information
                    </h2>

                    <div class="space-y-5">

                        <div>

                            <label class="block mb-2 text-sm font-medium">
                                Full Name
                            </label>

                            <input
                                type="text"
                                name="name"
                                value="{{ old('name', auth()->user()->name) }}"
                                class="w-full border border-slate-200 rounded-xl px-4 py-3"
                            >

                        </div>

                        <div>

                            <label class="block mb-2 text-sm font-medium">
                                Academic Title
                            </label>

                            <input
                                type="text"
                                name="academic_title"
                                value="{{ old('academic_title', $profile->academic_title) }}"
                                placeholder="Dr., Prof., M.Kom., etc."
                                class="w-full border border-slate-200 rounded-xl px-4 py-3"
                            >

                        </div>

                        <div>

                            <label class="block mb-2 text-sm font-medium">
                                University
                            </label>

                            <input
                                type="text"
                                name="university"
                                value="{{ old('university', $profile->university) }}"
                                class="w-full border border-slate-200 rounded-xl px-4 py-3"
                            >

                        </div>

                    </div>

                </div>

                <div class="bg-white rounded-2xl shadow-sm p-8">

                    <h2 class="text-xl font-bold mb-6">
                        Expertise
                    </h2>

                    <div class="space-y-5">

                        <div>

                            <label class="block mb-2 text-sm font-medium">
                                Academic Expertise
                            </label>

                            <input
                                type="text"
                                name="expertise"
                                value="{{ old('expertise', $profile->expertise) }}"
                                placeholder="Computer Science, Medicine, Law..."
                                class="w-full border border-slate-200 rounded-xl px-4 py-3"
                            >

                        </div>

                        <div>

                            <label class="block mb-2 text-sm font-medium">
                                Languages
                            </label>

                            <input
                                type="text"
                                name="languages"
                                value="{{ old('languages', $profile->languages) }}"
                                placeholder="English, Indonesian, Japanese"
                                class="w-full border border-slate-200 rounded-xl px-4 py-3"
                            >

                        </div>

                    </div>

                </div>

            </div>

            {{-- Right --}}
            <div class="space-y-6">

                <div class="bg-white rounded-2xl shadow-sm p-8">

                    <h2 class="text-xl font-bold mb-6">
                        Professional Information
                    </h2>

                    <div class="space-y-5">

                        <div>

                            <label class="block mb-2 text-sm font-medium">
                                Publication Count
                            </label>

                            <input
                                type="number"
                                name="publication_count"
                                min="0"
                                value="{{ old('publication_count', $profile->publication_count) }}"
                                class="w-full border border-slate-200 rounded-xl px-4 py-3"
                            >

                        </div>

                        <div>

                            <label class="block mb-2 text-sm font-medium">
                                Hourly Rate (IDR)
                            </label>

                            <input
                                type="number"
                                name="hourly_rate"
                                min="0"
                                value="{{ old('hourly_rate', $profile->hourly_rate) }}"
                                class="w-full border border-slate-200 rounded-xl px-4 py-3"
                            >

                        </div>

                    </div>

                </div>

                <div class="bg-white rounded-2xl shadow-sm p-8">

                    <h2 class="text-xl font-bold mb-6">
                        Biography
                    </h2>

                    <textarea
                        name="bio"
                        rows="10"
                        class="w-full border border-slate-200 rounded-xl px-4 py-3 resize-none"
                        placeholder="Tell clients about your academic background, translation experience, and expertise..."
                    >{{ old('bio', $profile->bio) }}</textarea>

                </div>

                <div class="bg-white rounded-2xl shadow-sm p-8">

                    <h2 class="text-xl font-bold mb-4">
                        Verification Status
                    </h2>

                    @php

                        $color = match($profile->verification_status)
                        {
                            'approved' => 'green',
                            'rejected' => 'red',
                            default => 'yellow'
                        };

                    @endphp

                    <span
                        class="
                            px-4 py-2 rounded-xl text-sm font-medium
                            bg-{{ $color }}-100
                            text-{{ $color }}-700
                        "
                    >

                        {{ ucfirst($profile->verification_status ?? 'pending') }}

                    </span>

                </div>

            </div>

        </div>

        <div class="mt-8 flex justify-end">

            <button
                type="submit"
                class="bg-indigo-600 text-white px-8 py-4 rounded-xl hover:bg-indigo-700 font-medium"
            >
                Save Profile
            </button>

        </div>

    </form>

</div>

@endsection