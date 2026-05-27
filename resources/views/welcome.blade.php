<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>MurkyNet — Telecom Platform</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-black text-white">

    <!-- NAVBAR -->
    <nav class="border-b border-zinc-800 bg-black/80 backdrop-blur sticky top-0 z-50">

        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

            <div class="text-2xl font-bold text-orange-500">
                MurkyNet
            </div>

            <div class="flex items-center gap-4">

                <a href="/login"
                    class="text-zinc-300 hover:text-white transition">

                    Login

                </a>

                <a href="/register"
                    class="bg-orange-500 hover:bg-orange-600 px-5 py-2 rounded-xl font-semibold transition">

                    Get Started

                </a>

            </div>

        </div>

    </nav>

    <!-- HERO -->
    <section class="py-24">

        <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-16 items-center">

            <div>

                <h1 class="text-5xl md:text-7xl font-black leading-tight mb-8">

                    Telecom Infrastructure
                    <span class="text-orange-500">
                        For Modern Communication
                    </span>

                </h1>

                <p class="text-zinc-400 text-xl mb-10 leading-relaxed">

                    Send SMS campaigns, manage caller IDs,
                    launch voice calls, monitor analytics,
                    and control your telecom operations
                    from one unified dashboard.

                </p>

                <div class="flex flex-wrap gap-4">

                    <a href="/register"
                        class="bg-orange-500 hover:bg-orange-600 px-8 py-4 rounded-2xl font-bold text-lg transition">

                        Start Now

                    </a>

                    <a href="/login"
                        class="border border-zinc-700 hover:border-zinc-500 px-8 py-4 rounded-2xl font-bold text-lg transition">

                        Login

                    </a>

                </div>

            </div>

            <!-- HERO CARD -->
            <div>

                <div class="bg-zinc-900 border border-zinc-800 rounded-3xl p-8 shadow-2xl">

                    <div class="grid grid-cols-2 gap-6">

                        <div class="bg-black rounded-2xl p-6 border border-zinc-800">

                            <p class="text-zinc-400 mb-2">
                                SMS Sent
                            </p>

                            <h3 class="text-4xl font-bold text-orange-500">
                                1.2M
                            </h3>

                        </div>

                        <div class="bg-black rounded-2xl p-6 border border-zinc-800">

                            <p class="text-zinc-400 mb-2">
                                Active Calls
                            </p>

                            <h3 class="text-4xl font-bold text-green-400">
                                8.4K
                            </h3>

                        </div>

                        <div class="bg-black rounded-2xl p-6 border border-zinc-800">

                            <p class="text-zinc-400 mb-2">
                                Delivery Rate
                            </p>

                            <h3 class="text-4xl font-bold text-blue-400">
                                99%
                            </h3>

                        </div>

                        <div class="bg-black rounded-2xl p-6 border border-zinc-800">

                            <p class="text-zinc-400 mb-2">
                                Uptime
                            </p>

                            <h3 class="text-4xl font-bold text-purple-400">
                                24/7
                            </h3>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- FEATURES -->
    <section class="py-24 border-t border-zinc-900">

        <div class="max-w-7xl mx-auto px-6">

            <div class="text-center mb-20">

                <h2 class="text-5xl font-black mb-6">
                    Platform Features
                </h2>

                <p class="text-zinc-400 text-xl">
                    Everything needed to operate telecom campaigns at scale.
                </p>

            </div>

            <div class="grid md:grid-cols-3 gap-8">

                <div class="bg-zinc-900 border border-zinc-800 rounded-3xl p-8">

                    <h3 class="text-2xl font-bold mb-4 text-orange-500">
                        Bulk SMS
                    </h3>

                    <p class="text-zinc-400 leading-relaxed">
                        Launch high-volume SMS campaigns
                        with delivery tracking and analytics.
                    </p>

                </div>

                <div class="bg-zinc-900 border border-zinc-800 rounded-3xl p-8">

                    <h3 class="text-2xl font-bold mb-4 text-green-400">
                        Voice Calls
                    </h3>

                    <p class="text-zinc-400 leading-relaxed">
                        Manage outbound calls and caller IDs
                        from a unified telecom dashboard.
                    </p>

                </div>

                <div class="bg-zinc-900 border border-zinc-800 rounded-3xl p-8">

                    <h3 class="text-2xl font-bold mb-4 text-blue-400">
                        Wallet Billing
                    </h3>

                    <p class="text-zinc-400 leading-relaxed">
                        Secure deposits, wallet management,
                        and transaction history included.
                    </p>

                </div>

            </div>

        </div>

    </section>

    <!-- PRICING -->
    <section class="py-24 border-t border-zinc-900">

        <div class="max-w-5xl mx-auto px-6">

            <div class="text-center mb-20">

                <h2 class="text-5xl font-black mb-6">
                    Pricing
                </h2>

                <p class="text-zinc-400 text-xl">
                    Transparent telecom pricing.
                </p>

            </div>

            <div class="grid md:grid-cols-3 gap-8">

                <!-- Starter -->
                <div class="bg-zinc-900 border border-zinc-800 rounded-3xl p-8">

                    <h3 class="text-2xl font-bold mb-4">
                        Starter
                    </h3>

                    <p class="text-5xl font-black mb-6">
                        $19
                    </p>

                    <ul class="space-y-3 text-zinc-400 mb-10">

                        <li>1,000 SMS/month</li>
                        <li>Basic analytics</li>
                        <li>Email support</li>

                    </ul>

                    <button class="w-full bg-zinc-800 hover:bg-zinc-700 py-4 rounded-2xl font-bold">
                        Choose Plan
                    </button>

                </div>

                <!-- Pro -->
                <div class="bg-orange-500 text-black rounded-3xl p-8 scale-105 shadow-2xl">

                    <h3 class="text-2xl font-bold mb-4">
                        Pro
                    </h3>

                    <p class="text-5xl font-black mb-6">
                        $99
                    </p>

                    <ul class="space-y-3 mb-10">

                        <li>50,000 SMS/month</li>
                        <li>Voice calls</li>
                        <li>Priority support</li>

                    </ul>

                    <button class="w-full bg-black text-white hover:bg-zinc-900 py-4 rounded-2xl font-bold">
                        Most Popular
                    </button>

                </div>

                <!-- Enterprise -->
                <div class="bg-zinc-900 border border-zinc-800 rounded-3xl p-8">

                    <h3 class="text-2xl font-bold mb-4">
                        Enterprise
                    </h3>

                    <p class="text-5xl font-black mb-6">
                        Custom
                    </p>

                    <ul class="space-y-3 text-zinc-400 mb-10">

                        <li>Unlimited campaigns</li>
                        <li>Dedicated support</li>
                        <li>Custom integrations</li>

                    </ul>

                    <button class="w-full bg-zinc-800 hover:bg-zinc-700 py-4 rounded-2xl font-bold">
                        Contact Sales
                    </button>

                </div>

            </div>

        </div>

    </section>

    <!-- CTA -->
    <section class="py-24 border-t border-zinc-900">

        <div class="max-w-4xl mx-auto px-6 text-center">

            <h2 class="text-5xl font-black mb-8">

                Ready To Scale Your Telecom Operations?

            </h2>

            <p class="text-zinc-400 text-xl mb-10">

                Create your MurkyNet account and start
                managing SMS and voice campaigns today.

            </p>

            <a href="/register"
                class="inline-block bg-orange-500 hover:bg-orange-600 px-10 py-5 rounded-2xl font-bold text-xl transition">

                Create Account

            </a>

        </div>

    </section>

    <!-- FOOTER -->
    <footer class="border-t border-zinc-900 py-10">

        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-4">

            <p class="text-zinc-500">
                © {{ date('Y') }} MurkyNet. All rights reserved.
            </p>

            <div class="flex gap-6 text-zinc-500">

                <a href="/login" class="hover:text-white">
                    Login
                </a>

                <a href="/register" class="hover:text-white">
                    Register
                </a>

            </div>

        </div>

    </footer>

</body>

</html>