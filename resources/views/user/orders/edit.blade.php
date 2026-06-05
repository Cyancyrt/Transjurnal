@extends('layouts.app')

@section('content')

<div class="max-w-5xl mx-auto">

    <div class="bg-gradient-to-r from-amber-500 to-orange-500 rounded-3xl p-10 text-white mb-8">

        <h1 class="text-4xl font-bold">
            Edit Translation Request
        </h1>

        <p class="mt-3 text-orange-100">
            You may edit this request because it has not yet been accepted by a translator.
        </p>

    </div>

    <div class="bg-yellow-50 border border-yellow-200 rounded-2xl p-5 mb-8">

        <div class="flex items-start gap-3">

            <i class="bi bi-exclamation-triangle-fill text-yellow-600 text-xl"></i>

            <div>

                <h3 class="font-semibold text-yellow-800">
                    Important Notice
                </h3>

                <p class="text-yellow-700 mt-1">
                    Once a translator accepts your request, this order can no longer be edited.
                </p>

            </div>

        </div>

    </div>

    <form
        action="{{ route('user.orders.update', $order) }}"
        method="POST"
        enctype="multipart/form-data"
    >
        @csrf
        @method('PUT')

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

                        @foreach($services as $service)

                            <option
                                value="{{ $service->id }}"
                                @selected(old('service_id', $order->service_id) == $service->id)
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
                        value="{{ old('field', $order->field) }}"
                        class="w-full border border-slate-300 rounded-xl px-4 py-3"
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
                    value="{{ old('title', $order->title) }}"
                    class="w-full border border-slate-300 rounded-xl px-4 py-3"
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
                    required
                >{{ old('description', $order->description) }}</textarea>

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

                    <input
                        type="text"
                        name="source_language"
                        value="{{ old('source_language', $order->source_language) }}"
                        class="w-full border border-slate-300 rounded-xl px-4 py-3"
                        required
                    >

                </div>

                <div>

                    <label class="block mb-2 font-medium">
                        Target Language
                    </label>

                    <input
                        type="text"
                        name="target_language"
                        value="{{ old('target_language', $order->target_language) }}"
                        class="w-full border border-slate-300 rounded-xl px-4 py-3"
                        required
                    >

                </div>

            </div>

            {{-- Current File --}}
            <div class="mt-8">

                <label class="block mb-3 font-medium">
                    Current Journal File
                </label>

                <div class="bg-slate-50 border rounded-xl p-4 flex items-center justify-between">

                    <div>

                        <p class="font-medium">
                            {{ basename($order->journal_file) }}
                        </p>

                        <p class="text-sm text-slate-500">
                            Uploaded on {{ $order->created_at->format('d M Y') }}
                        </p>

                    </div>

                    <a
                        href="{{ asset('storage/' . $order->journal_file) }}"
                        target="_blank"
                        class="bg-slate-900 text-white px-4 py-2 rounded-lg"
                    >
                        View File
                    </a>

                </div>

            </div>

            {{-- Upload New File --}}
            <div class="mt-6">

                <label class="block mb-2 font-medium">
                    Replace Journal File (Optional)
                </label>

                <input
                    type="file"
                    name="journal_file"
                    accept=".pdf,.doc,.docx,.txt"
                    class="w-full border border-slate-300 rounded-xl px-4 py-3"
                >

                <p class="text-sm text-slate-500 mt-2">
                    Supported formats: PDF, DOC, DOCX, TXT (Max 10 MB)
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
                href="{{ route('user.orders.show', $order) }}"
                class="px-6 py-3 bg-slate-200 rounded-xl"
            >
                Cancel
            </a>

            <button
                type="submit"
                class="px-8 py-3 bg-indigo-600 text-white rounded-xl font-semibold hover:bg-indigo-700"
            >
                Update Order
            </button>

        </div>

    </form>

</div>

@endsection