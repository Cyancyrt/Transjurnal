@extends('layouts.admin')

@section('page-title', 'Edit Service')

@section('content')

<div class="max-w-4xl mx-auto space-y-6">

    <div>

        <h1 class="text-2xl font-bold text-slate-800">
            Edit Service
        </h1>

        <p class="text-sm text-slate-500 mt-1">
            Update service information available on the platform.
        </p>

    </div>

    @if ($errors->any())

        <div
        class="bg-red-50 border border-red-200
        text-red-700 rounded-2xl p-4">

            <ul class="list-disc pl-5 space-y-1">

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <form
        method="POST"
        action="{{ route('admin.services.update', $service) }}"
        class="bg-white border border-slate-200 rounded-2xl p-6 space-y-6">

        @csrf
        @method('PUT')

        <div>

            <label
            class="block text-sm font-medium text-slate-700 mb-2">

                Service Name

            </label>

            <input
                type="text"
                name="name"
                value="{{ old('name', $service->name) }}"
                class="w-full border border-slate-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500">

        </div>

        <div>

            <label
            class="block text-sm font-medium text-slate-700 mb-2">

                Description

            </label>

            <textarea
                name="description"
                rows="6"
                class="w-full border border-slate-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description', $service->description) }}</textarea>

        </div>

        <div>

            <label
            class="block text-sm font-medium text-slate-700 mb-2">

                Base Price (Rp)

            </label>

            <input
                type="number"
                name="base_price"
                value="{{ old('base_price', $service->base_price) }}"
                min="0"
                step="0.01"
                class="w-full border border-slate-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500">

        </div>

        <div
        class="flex items-center justify-between
        pt-4 border-t border-slate-200">

            <a
                href="{{ route('admin.services.index') }}"
                class="px-5 py-2.5 border border-slate-300 rounded-xl hover:bg-slate-50">

                Cancel

            </a>

            <button
                type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-xl">

                Update Service

            </button>

        </div>

    </form>

</div>

@endsection