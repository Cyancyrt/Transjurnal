@if(session('success'))

<div
class="mb-6 bg-green-100 border border-green-200 text-green-700 p-4 rounded-2xl">

    {{ session('success') }}

</div>

@endif

@if(session('error'))

<div
class="mb-6 bg-red-100 border border-red-200 text-red-700 p-4 rounded-2xl">

    {{ session('error') }}

</div>

@endif

@if(session('warning'))

<div
class="mb-6 bg-yellow-100 border border-yellow-200 text-yellow-700 p-4 rounded-2xl">

    {{ session('warning') }}

</div>

@endif