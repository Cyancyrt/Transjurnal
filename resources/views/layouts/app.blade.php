<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="bg-slate-100">

<div class="min-h-screen flex">

    @include('components.sidebar')

    <div class="flex-1 min-w-0 flex flex-col">

        @include('components.topbar')

        <main class="flex-1 p-8 overflow-x-auto">
            @yield('content')
        </main>

    </div>

</div>

</body>
</html>