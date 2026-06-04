@extends('layouts.app')

@section('content')

<h1 class="text-3xl font-bold mb-6">
    User Dashboard
</h1>

<div class="grid grid-cols-3 gap-6">

    <div class="bg-white p-6 rounded shadow">

        <h3 class="text-gray-500">
            Total Orders
        </h3>

        <p class="text-3xl font-bold">
            12
        </p>

    </div>

    <div class="bg-white p-6 rounded shadow">

        <h3 class="text-gray-500">
            Active Orders
        </h3>

        <p class="text-3xl font-bold">
            3
        </p>

    </div>

    <div class="bg-white p-6 rounded shadow">

        <h3 class="text-gray-500">
            Completed Orders
        </h3>

        <p class="text-3xl font-bold">
            9
        </p>

    </div>

</div>

@endsection