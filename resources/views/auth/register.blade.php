@extends('layouts.guest')

@section('content')

<div class="min-h-screen flex">

    <!-- Left -->

    <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-blue-900 via-blue-700 to-indigo-700 text-white items-center justify-center">

        <div class="max-w-md">

            <h1 class="text-5xl font-bold leading-tight">
                Join ScholarBridge
            </h1>

            <p class="mt-6 text-xl text-blue-100">

                Connect researchers with verified
                lecturers and professors from around the world.

            </p>

        </div>

    </div>

    <!-- Right -->

    <div class="w-full lg:w-1/2 flex items-center justify-center bg-gray-50">

        <div class="w-full max-w-lg bg-white p-10 rounded-2xl shadow-lg">

            <div class="text-center mb-8">

                <h2 class="text-3xl font-bold">
                    Create Account
                </h2>

                <p class="text-gray-500 mt-2">
                    Start your academic journey today
                </p>

            </div>

            @if($errors->any())

                <div class="mb-4 bg-red-100 text-red-700 p-3 rounded">

                    {{ $errors->first() }}

                </div>

            @endif

            <form method="POST" action="/register">

                @csrf

                <div class="mb-4">

                    <label class="block mb-2 text-sm font-medium">
                        Full Name
                    </label>

                    <input
                        type="text"
                        name="name"
                        required
                        class="w-full border rounded-lg px-4 py-3">

                </div>

                <div class="mb-4">

                    <label class="block mb-2 text-sm font-medium">
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        required
                        class="w-full border rounded-lg px-4 py-3">

                </div>

                <div class="mb-4">

                    <label class="block mb-2 text-sm font-medium">
                        Account Type
                    </label>

                    <select
                        name="role"
                        required
                        class="w-full border rounded-lg px-4 py-3">

                        <option value="user">
                            Researcher / Student
                        </option>

                        <option value="translator">
                            Lecturer / Professor
                        </option>

                    </select>

                </div>

                <div class="mb-4">

                    <label class="block mb-2 text-sm font-medium">
                        Password
                    </label>

                    <input
                        type="password"
                        name="password"
                        required
                        class="w-full border rounded-lg px-4 py-3">

                </div>

                <div class="mb-6">

                    <label class="block mb-2 text-sm font-medium">
                        Confirm Password
                    </label>

                    <input
                        type="password"
                        name="password_confirmation"
                        required
                        class="w-full border rounded-lg px-4 py-3">

                </div>

                <button
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-semibold">

                    Create Account

                </button>

            </form>

            <p class="text-center text-gray-500 mt-6">

                Already have an account?

                <a href="/login"
                   class="text-blue-600 font-semibold">

                    Login

                </a>

            </p>

        </div>

    </div>

</div>

@endsection