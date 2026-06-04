<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>
    @yield('title', 'ScholarBridge Admin')
</title>

<script src="https://cdn.tailwindcss.com"></script>

<link
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
rel="stylesheet">

<style>

html,
body{
    height:100%;
    overflow:hidden;
}

body{
    background:
    radial-gradient(
        circle at top left,
        rgba(59,130,246,.12),
        transparent 25%
    ),
    radial-gradient(
        circle at bottom right,
        rgba(139,92,246,.10),
        transparent 25%
    ),
    #f8fafc;
}

.glass{
    backdrop-filter:blur(18px);
    background:rgba(255,255,255,.75);
}

.custom-scroll::-webkit-scrollbar{
    width:8px;
    height:8px;
}

.custom-scroll::-webkit-scrollbar-thumb{
    background:#cbd5e1;
    border-radius:999px;
}

.custom-scroll::-webkit-scrollbar-track{
    background:transparent;
}

</style>

</head>

<body>

<div class="h-screen flex overflow-hidden">

    {{-- SIDEBAR --}}
    <aside
    class="w-64 shrink-0 bg-slate-950 text-white
    flex flex-col shadow-2xl">

        @include('components.admin.sidebar')

    </aside>

    {{-- RIGHT SIDE --}}
    <div class="flex-1 flex flex-col min-w-0">

        {{-- TOPBAR --}}
        <div class="shrink-0">

            @include('components.admin.topbar')

        </div>

        {{-- CONTENT --}}
        <main
        class="flex-1 overflow-y-auto overflow-x-auto custom-scroll p-8">
            @include('components.flashMessage')

            @yield('content')

        </main>

    </div>

</div>

</body>

</html>