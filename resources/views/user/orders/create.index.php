    <x-app-layout>

<div class="max-w-4xl mx-auto p-6">

    <h1 class="text-2xl font-bold mb-5">
        Create Translation Order
    </h1>

    <form
        method="POST"
        action="{{ route('user.orders.store') }}"
        enctype="multipart/form-data"
    >

        @csrf

        <input
            type="text"
            name="title"
            placeholder="Journal Title"
            class="w-full border p-3 mb-3"
        >

        <textarea
            name="description"
            placeholder="Description"
            class="w-full border p-3 mb-3"
        ></textarea>

        <input
            type="text"
            name="source_language"
            placeholder="Source Language"
            class="w-full border p-3 mb-3"
        >

        <input
            type="text"
            name="target_language"
            placeholder="Target Language"
            class="w-full border p-3 mb-3"
        >

        <select
            name="service_id"
            class="w-full border p-3 mb-3"
        >

            @foreach($services as $service)

                <option
                    value="{{ $service->id }}"
                >
                    {{ $service->name }}
                    -
                    Rp {{ number_format($service->base_price) }}
                </option>

            @endforeach

        </select>

        <input
            type="file"
            name="journal_file"
            class="mb-5"
        >

        <button
            class="bg-blue-600 text-white px-6 py-3 rounded"
        >
            Submit Order
        </button>

    </form>

</div>

</x-app-layout>