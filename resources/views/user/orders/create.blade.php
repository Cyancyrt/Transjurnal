@extends('layouts.app')

@section('content')

<div class="max-w-5xl mx-auto">

    <div class="bg-gradient-to-r from-indigo-600 to-blue-600 rounded-3xl p-10 text-white mb-8">

        <h1 class="text-4xl font-bold">
            New Translation Request
        </h1>

        <p class="mt-3 text-indigo-100">
            Submit your academic journal and let our verified scholars handle the translation.
        </p>

    </div>

    <form
        action="{{ route('user.orders.store') }}"
        method="POST"
        enctype="multipart/form-data"
    >
        @csrf

        <div class="bg-white rounded-3xl shadow-sm p-8">

            <div class="grid md:grid-cols-2 gap-6">

                {{-- Service --}}
                <div>

                    <label class="block mb-2 font-medium">
                        Translation Service
                    </label>

                    <select
                        name="service_id"
                        class="w-full border border-slate-300 rounded-xl px-4 py-3"
                        required
                    >

                        <option value="">
                            Select Service
                        </option>

                        @foreach($services as $service)

                            <option
                                value="{{ $service->id }}"
                                @selected(old('service_id') == $service->id)
                            >
                                {{ $service->name }}
                                -
                                Rp {{ number_format($service->base_price,0,',','.') }}
                            </option>

                        @endforeach

                    </select>

                    @error('service_id')
                        <p class="text-red-500 text-sm mt-2">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

                {{-- Field --}}
                <div>

                    <label class="block mb-2 font-medium">
                        Academic Field
                    </label>

                    <input
                        type="text"
                        name="field"
                        value="{{ old('field') }}"
                        class="w-full border border-slate-300 rounded-xl px-4 py-3"
                        placeholder="Artificial Intelligence"
                        required
                    >

                    @error('field')
                        <p class="text-red-500 text-sm mt-2">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

            </div>

            {{-- Title --}}
            <div class="mt-6">

                <label class="block mb-2 font-medium">
                    Journal Title
                </label>

                <input
                    type="text"
                    name="title"
                    value="{{ old('title') }}"
                    class="w-full border border-slate-300 rounded-xl px-4 py-3"
                    placeholder="Artificial Intelligence in Healthcare"
                    required
                >

                @error('title')
                    <p class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            {{-- Description --}}
            <div class="mt-6">

                <label class="block mb-2 font-medium">
                    Description
                </label>

                <textarea
                    name="description"
                    rows="6"
                    class="w-full border border-slate-300 rounded-xl px-4 py-3"
                    placeholder="Provide additional information about your journal translation requirements..."
                    required
                >{{ old('description') }}</textarea>

                @error('description')
                    <p class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            {{-- Languages --}}
            <div class="grid md:grid-cols-2 gap-6 mt-6">

                <div>

                    <label class="block mb-2 font-medium">
                        Source Language
                    </label>

                    <select
                        name="source_language"
                        class="w-full border border-slate-300 rounded-xl px-4 py-3"
                        required
                    >

                        <option value="">
                            Select Language
                        </option>

                        <option value="Indonesian">
                            Indonesian
                        </option>

                        <option value="English">
                            English
                        </option>

                    </select>

                    @error('source_language')
                        <p class="text-red-500 text-sm mt-2">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

                <div>

                    <label class="block mb-2 font-medium">
                        Target Language
                    </label>

                    <select
                        name="target_language"
                        class="w-full border border-slate-300 rounded-xl px-4 py-3"
                        required
                    >

                        <option value="">
                            Select Language
                        </option>

                        <option value="English">
                            English
                        </option>

                        <option value="Indonesian">
                            Indonesian
                        </option>

                    </select>

                    @error('target_language')
                        <p class="text-red-500 text-sm mt-2">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

            </div>

            {{-- File Upload --}}
            <div class="mt-6">

                <label class="block mb-2 font-medium">
                    Journal File (PDF)
                </label>

                <input
                    type="file"
                    name="journal_file"
                    accept=".pdf"
                    class="w-full border border-slate-300 rounded-xl px-4 py-3"
                    required
                >

                <p class="text-sm text-slate-500 mt-2">
                    Maximum file size: 10 MB
                </p>

                @error('journal_file')
                    <p class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </p>
                @enderror

            </div>

        </div>

        {{-- Actions --}}
        <div class="flex justify-end gap-4 mt-8">

            <a
                href="{{ route('user.orders.index') }}"
                class="px-6 py-3 bg-slate-200 rounded-xl"
            >
                Cancel
            </a>

            <button
                type="submit"
                class="px-8 py-3 bg-indigo-600 text-white rounded-xl font-semibold hover:bg-indigo-700"
            >
                Submit Request
            </button>

        </div>

    </form>

</div>

@endsection