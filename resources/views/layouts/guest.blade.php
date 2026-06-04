<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ScholarBridge</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-white">

    <!-- Navbar -->
    <nav class="border-b bg-white sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

            <a href="/" class="text-2xl font-bold text-blue-700">
                ScholarBridge
            </a>

            <div class="flex items-center gap-4">

                <a href="#services"
                    class="text-gray-600 hover:text-blue-600">
                    Services
                </a>

                <a href="#how-it-works"
                    class="text-gray-600 hover:text-blue-600">
                    How It Works
                </a>

                <a href="/login"
                    class="px-4 py-2 rounded-lg border">
                    Login
                </a>

                <a href="/register"
                    class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700">
                    Get Started
                </a>

            </div>

        </div>
    </nav>

    @yield('content')

</body>

</html>