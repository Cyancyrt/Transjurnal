<header
class="glass
border-b border-white/40
sticky top-0 z-50">

    <div
    class="px-8 py-4 flex justify-between items-center">

        <div>

            <h1
            class="font-bold text-xl text-slate-800">

                @yield('page-title')

            </h1>

            <p
            class="text-sm text-slate-500">

                {{ now()->format('l, d F Y') }}

            </p>

        </div>

        <div
        class="flex items-center gap-3">

            <button
            class="w-10 h-10 rounded-xl bg-white shadow">

                <i class="bi bi-bell"></i>

            </button>

            <form
            method="POST"
            action="{{ route('logout') }}">

                @csrf

                <button
                class="px-4 py-2 rounded-xl
                bg-red-500 text-white">

                    Logout

                </button>

            </form>

        </div>

    </div>

</header>