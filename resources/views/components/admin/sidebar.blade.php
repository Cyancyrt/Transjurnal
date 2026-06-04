<div class="h-full flex flex-col">

    {{-- BRAND --}}

    <div class="px-6 py-6 border-b border-slate-800">

        <div class="flex items-center gap-3">

            <div
            class="w-11 h-11 rounded-2xl
            bg-gradient-to-br
            from-blue-500
            via-violet-500
            to-purple-600
            flex items-center justify-center">

                <i class="bi bi-book-half text-white"></i>

            </div>

            <div>

                <h2 class="font-bold text-white">
                    ScholarBridge
                </h2>

                <p class="text-xs text-slate-400">
                    Administration Panel
                </p>

            </div>

        </div>

    </div>

    {{-- MENU --}}

    <div class="flex-1 overflow-y-auto px-3 py-5">

        {{-- OVERVIEW --}}

        <div class="mb-6">

            <p class="px-3 mb-2 text-[10px] uppercase tracking-[0.15em] text-slate-500">

                Overview

            </p>

            <a
            href="{{ route('admin.dashboard') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 text-slate-300">

                <i class="bi bi-grid"></i>

                Dashboard

            </a>

            <a
            href="#"
            class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 text-slate-300">

                <i class="bi bi-patch-check"></i>

                Verification

                <span
                class="ml-auto text-[10px]
                bg-orange-500 text-white
                px-2 py-0.5 rounded-full">

                    12

                </span>

            </a>

        </div>

        {{-- MANAGEMENT --}}

        <div class="mb-6">

            <p class="px-3 mb-2 text-[10px] uppercase tracking-[0.15em] text-slate-500">

                Management

            </p>

            <a
            href="{{ route('admin.orders.index') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 text-slate-300">

                <i class="bi bi-journal-text"></i>

                Orders

            </a>

            <a
            href="{{ route('admin.scholars.index') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 text-slate-300">

                <i class="bi bi-mortarboard"></i>

                Scholars

            </a>

            <a
            href="{{ route('admin.users.index') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 text-slate-300">

                <i class="bi bi-people"></i>

                Users

            </a>

        </div>

        {{-- BUSINESS --}}

        <div class="mb-6">

            <p class="px-3 mb-2 text-[10px] uppercase tracking-[0.15em] text-slate-500">

                Business

            </p>

            <a
            href="{{ route('admin.services.index') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 text-slate-300">

                <i class="bi bi-briefcase"></i>

                Services

            </a>

            <a
            href="{{ route('admin.reports.index') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 text-slate-300">

                <i class="bi bi-bar-chart"></i>

                Reports

            </a>

        </div>

        {{-- SYSTEM --}}

        <div>

            <p class="px-3 mb-2 text-[10px] uppercase tracking-[0.15em] text-slate-500">

                System

            </p>

            <a
            href="#"
            class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 text-slate-300">

                <i class="bi bi-gear"></i>

                Settings

            </a>

        </div>

    </div>

    {{-- PROFILE --}}

    <div class="p-4 border-t border-slate-800">

        <div class="bg-slate-900/70 rounded-2xl p-4">

            <div class="flex items-center gap-3">

                <div
                class="w-11 h-11 rounded-full
                bg-gradient-to-br
                from-blue-500
                to-violet-600
                flex items-center justify-center
                text-white font-semibold">

                    {{ strtoupper(substr(auth()->user()->name,0,1)) }}

                </div>

                <div>

                    <p class="font-medium text-sm text-white">

                        {{ auth()->user()->name }}

                    </p>

                    <p class="text-xs text-slate-400">

                        Platform Administrator

                    </p>

                </div>

            </div>

        </div>

    </div>

</div>