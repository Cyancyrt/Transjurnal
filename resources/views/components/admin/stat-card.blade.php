@props([
'title',
'value',
'icon',
'color'
])

<div
class="bg-white rounded-3xl p-6
shadow-[0_10px_30px_rgba(0,0,0,.05)]
hover:-translate-y-1
transition">

    <div
    class="flex justify-between">

        <div>

            <p
            class="text-slate-500 text-sm">

                {{ $title }}

            </p>

            <h2
            class="text-4xl font-bold mt-2">

                {{ $value }}

            </h2>

        </div>

        <div
        class="w-14 h-14 rounded-2xl
        {{ $color }}
        flex items-center justify-center
        text-white text-xl">

            <i class="{{ $icon }}"></i>

        </div>

    </div>

</div>