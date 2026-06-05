<aside class="w-72 bg-slate-900 text-slate-200 h-screen sticky top-0 flex flex-col shadow-xl overflow-y-auto flex-shrink-0">
    {{-- Brand --}}
    <div class="h-20 px-6 flex items-center border-b border-slate-800">

        <div>

            <h1 class="text-2xl font-bold text-white">
                ScholarBridge
            </h1>

            <p class="text-xs text-slate-400">
                Academic Translation Platform
            </p>

        </div>

    </div>

    {{-- Navigation --}}
    <nav class="flex-1 px-4 py-6 overflow-y-auto">

        {{-- USER --}}
        @if(auth()->user()->role == 'user')

            <p class="px-3 mb-3 text-xs font-semibold uppercase tracking-wider text-slate-500">
                Main Menu
            </p>

            <div class="space-y-1">

                <a href="{{ route('user.dashboard') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 transition">

                    <i class="bi bi-grid-1x2-fill"></i>

                    <span>
                        Dashboard
                    </span>

                </a>

                <a href="{{ route('user.scholars.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 transition">

                    <i class="bi bi-mortarboard-fill"></i>

                    <span>
                        Browse Scholars
                    </span>

                </a>

                <a href="{{ route('user.services.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 transition">

                    <i class="bi bi-briefcase-fill"></i>

                    <span>
                        Services
                    </span>

                </a>

            </div>

            <p class="px-3 mt-8 mb-3 text-xs font-semibold uppercase tracking-wider text-slate-500">
                Translation
            </p>

            <div class="space-y-1">

                <a href="{{ route('user.orders.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 transition">

                    <i class="bi bi-journal-text"></i>

                    <span>
                        My Orders
                    </span>

                </a>

                <a href="{{ route('user.translations.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 transition">

                    <i class="bi bi-file-earmark-check-fill"></i>

                    <span>
                        Completed Translations
                    </span>

                </a>

            </div>

        @endif

        {{-- TRANSLATOR --}}
        @if(auth()->user()->role == 'translator')

            <p class="px-3 mb-3 text-xs font-semibold uppercase tracking-wider text-slate-500">
                Translator Workspace
            </p>

            <div class="space-y-1">

                <a href="{{ route('translator.dashboard') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 transition">

                    <i class="bi bi-grid-1x2-fill"></i>

                    <span>
                        Dashboard
                    </span>

                </a>

                <a href="{{ route('translator.jobs.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 transition">

                    <i class="bi bi-search"></i>

                    <span>
                        Available Jobs
                    </span>

                </a>

                <a href="{{ route('translator.orders.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 transition">

                    <i class="bi bi-folder-check"></i>

                    <span>
                        Assigned Orders
                    </span>

                </a>

                <a href="{{ route('translator.profile') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 transition">

                    <i class="bi bi-person-badge-fill"></i>

                    <span>
                        My Profile
                    </span>

                </a>

            </div>

        @endif

    </nav>

    {{-- Footer --}}
    <div class="p-4 border-t border-slate-800">

        <div class="bg-slate-800 rounded-xl p-4">

            <p class="font-medium text-white">
                {{ auth()->user()->name }}
            </p>

            <p class="text-sm text-slate-400 capitalize">
                {{ auth()->user()->role }}
            </p>

        </div>

    </div>

</aside>