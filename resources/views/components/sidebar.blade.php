<aside class="w-64 bg-slate-900 text-white min-h-screen">

    <div class="p-6 border-b border-slate-700">

        <h1 class="font-bold text-xl">
            ScholarBridge
        </h1>

    </div>

    <nav class="p-4 space-y-2">

        @if(auth()->user()->role == 'user')

            <a href="/user/dashboard"
               class="block px-4 py-3 rounded hover:bg-slate-700">
                Dashboard
            </a>

            <a href="/user/orders"
               class="block px-4 py-3 rounded hover:bg-slate-700">
                Orders
            </a>

        @endif

        @if(auth()->user()->role == 'translator')

            <a href="/translator/dashboard"
               class="block px-4 py-3 rounded hover:bg-slate-700">
                Dashboard
            </a>

            <a href="#"
               class="block px-4 py-3 rounded hover:bg-slate-700">
                Available Jobs
            </a>

        @endif

        @if(auth()->user()->role == 'admin')

            <a href="/admin/dashboard"
               class="block px-4 py-3 rounded hover:bg-slate-700">
                Dashboard
            </a>

            <a href="#"
               class="block px-4 py-3 rounded hover:bg-slate-700">
                Translators
            </a>

        @endif

    </nav>

</aside>