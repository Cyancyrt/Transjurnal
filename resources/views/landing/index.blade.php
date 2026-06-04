@extends('layouts.guest')

@section('content')

<!-- HERO -->
<section class="bg-gradient-to-br from-blue-900 via-blue-700 to-indigo-700 text-white">

    <div class="max-w-7xl mx-auto px-6 py-28">

        <div class="grid lg:grid-cols-2 gap-16 items-center">

            <div>

                <span class="bg-white/20 px-4 py-2 rounded-full text-sm">
                    Academic Translation Marketplace
                </span>

                <h1 class="text-6xl font-bold mt-8 leading-tight">

                    Translate Research Papers
                    with Verified Scholars

                </h1>

                <p class="mt-8 text-xl text-blue-100">

                    Work directly with verified lecturers and professors
                    for accurate journal translation, summaries,
                    and academic insights.

                </p>

                <div class="mt-10 flex gap-4">

                    <a href="/register"
                        class="bg-white text-blue-700 px-8 py-4 rounded-xl font-semibold">

                        Start Now

                    </a>

                    <a href="#services"
                        class="border border-white px-8 py-4 rounded-xl">

                        Explore Services

                    </a>

                </div>

            </div>

            <div>

                <div class="bg-white rounded-3xl p-8 shadow-2xl">

                    <div class="flex justify-between items-center">

                        <div>
                            <p class="text-gray-500 text-sm">
                                Service
                            </p>

                            <h3 class="font-bold text-black text-xl">
                                Translation + Summary
                            </h3>
                        </div>

                        <span
                            class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                            Active
                        </span>

                    </div>

                    <hr class="my-6">

                    <div class="space-y-4 text-black">

                        <div>
                            <p class="text-gray-500 text-sm">
                                Source Language
                            </p>

                            <p class="font-semibold">
                                Japanese
                            </p>
                        </div>

                        <div>
                            <p class="text-gray-500 text-sm">
                                Target Language
                            </p>

                            <p class="font-semibold">
                                English
                            </p>
                        </div>

                        <div>
                            <p class="text-gray-500 text-sm">
                                Assigned Translator
                            </p>

                            <p class="font-semibold">
                                Verified Professor
                            </p>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- STATS -->
<section class="py-20">

    <div class="max-w-6xl mx-auto px-6">

        <div class="grid md:grid-cols-4 gap-8">

            <div class="text-center">
                <h3 class="text-5xl font-bold text-blue-600">
                    500+
                </h3>
                <p class="text-gray-500 mt-2">
                    Completed Orders
                </p>
            </div>

            <div class="text-center">
                <h3 class="text-5xl font-bold text-blue-600">
                    120+
                </h3>
                <p class="text-gray-500 mt-2">
                    Verified Scholars
                </p>
            </div>

            <div class="text-center">
                <h3 class="text-5xl font-bold text-blue-600">
                    98%
                </h3>
                <p class="text-gray-500 mt-2">
                    Satisfaction Rate
                </p>
            </div>

            <div class="text-center">
                <h3 class="text-5xl font-bold text-blue-600">
                    30+
                </h3>
                <p class="text-gray-500 mt-2">
                    Supported Languages
                </p>
            </div>

        </div>

    </div>

</section>

<!-- HOW IT WORKS -->
<section id="how-it-works" class="bg-gray-50 py-24">

    <div class="max-w-6xl mx-auto px-6">

        <h2 class="text-4xl font-bold text-center mb-16">
            How It Works
        </h2>

        <div class="grid md:grid-cols-3 gap-8">

            <div class="bg-white p-8 rounded-2xl shadow">

                <div class="text-4xl mb-4">
                    📄
                </div>

                <h3 class="font-bold text-xl">
                    Upload Journal
                </h3>

                <p class="text-gray-600 mt-3">
                    Upload your research paper or journal.
                </p>

            </div>

            <div class="bg-white p-8 rounded-2xl shadow">

                <div class="text-4xl mb-4">
                    🎓
                </div>

                <h3 class="font-bold text-xl">
                    Scholar Review
                </h3>

                <p class="text-gray-600 mt-3">
                    Verified academics process your request.
                </p>

            </div>

            <div class="bg-white p-8 rounded-2xl shadow">

                <div class="text-4xl mb-4">
                    🚀
                </div>

                <h3 class="font-bold text-xl">
                    Receive Result
                </h3>

                <p class="text-gray-600 mt-3">
                    Download translated files and summaries.
                </p>

            </div>

        </div>

    </div>

</section>

<!-- SERVICES -->
<section id="services" class="py-24">

    <div class="max-w-6xl mx-auto px-6">

        <h2 class="text-4xl font-bold text-center mb-16">
            Service Packages
        </h2>

        <div class="grid lg:grid-cols-3 gap-8">

            <div class="border rounded-2xl p-8">

                <h3 class="text-2xl font-bold">
                    Basic
                </h3>

                <p class="text-gray-500 mt-2">
                    Translation only
                </p>

                <div class="text-4xl font-bold mt-8">
                    Rp50K
                </div>

            </div>

            <div class="border-2 border-blue-600 rounded-2xl p-8 relative">

                <span
                    class="absolute -top-3 left-6 bg-blue-600 text-white px-3 py-1 rounded-full text-sm">

                    Popular

                </span>

                <h3 class="text-2xl font-bold">
                    Summary
                </h3>

                <p class="text-gray-500 mt-2">
                    Translation + Summary
                </p>

                <div class="text-4xl font-bold mt-8">
                    Rp100K
                </div>

            </div>

            <div class="border rounded-2xl p-8">

                <h3 class="text-2xl font-bold">
                    Academic Insight
                </h3>

                <p class="text-gray-500 mt-2">
                    Full analysis package
                </p>

                <div class="text-4xl font-bold mt-8">
                    Rp150K
                </div>

            </div>

        </div>

    </div>

</section>

<!-- CTA -->
<section class="bg-blue-700 text-white py-24">

    <div class="max-w-4xl mx-auto text-center px-6">

        <h2 class="text-5xl font-bold">

            Ready To Translate Your Research?

        </h2>

        <p class="mt-6 text-xl text-blue-100">

            Join ScholarBridge and connect with verified scholars today.

        </p>

        <a href="/register"
            class="inline-block mt-10 bg-white text-blue-700 px-8 py-4 rounded-xl font-bold">

            Create Account

        </a>

    </div>

</section>

<!-- FOOTER -->
<footer class="bg-slate-900 text-white py-12">

    <div class="max-w-7xl mx-auto px-6">

        <h3 class="font-bold text-2xl">
            ScholarBridge
        </h3>

        <p class="text-slate-400 mt-3">
            Academic Translation Marketplace
        </p>

    </div>

</footer>

@endsection