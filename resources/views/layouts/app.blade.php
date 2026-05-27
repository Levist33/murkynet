<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>MurkyNet</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-black text-white">

    <div
        x-data="{
            sidebarOpen: false,
            notificationsOpen: false
        }"
        class="min-h-screen flex">

        <!-- SIDEBAR -->
        <aside
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed z-50 inset-y-0 left-0 w-72 bg-zinc-950 border-r border-zinc-800 transform transition-transform duration-300 lg:translate-x-0 lg:static lg:inset-0">

            <!-- LOGO -->
            <div class="h-20 flex items-center px-8 border-b border-zinc-800">

                <a href="/dashboard-ui"
                    class="text-3xl font-black text-orange-500">

                    MurkyNet

                </a>

                <a href="/tickets"
                   class="flex items-center gap-4 px-5 py-4 rounded-2xl hover:bg-zinc-900 transition">
 
                    <span>🎫</span>

                    <span>Support</span>

                </a>

            </div>

            <!-- NAVIGATION -->
            <nav class="p-6 space-y-2 overflow-y-auto">

                <a href="/profile"
                    class="flex items-center gap-4 px-5 py-4 rounded-2xl hover:bg-zinc-900 transition">

                    <span>👤</span>

                    <span>Profile</span>

                </a>

                <a href="/dashboard-ui"
                    class="flex items-center gap-4 px-5 py-4 rounded-2xl hover:bg-zinc-900 transition">

                    <span>📊</span>

                    <span>Dashboard</span>

                </a>

                <a href="/send-sms"
                    class="flex items-center gap-4 px-5 py-4 rounded-2xl hover:bg-zinc-900 transition">

                    <span>📨</span>

                    <span>Bulk SMS</span>

                </a>

                <a href="/sms-history"
                    class="flex items-center gap-4 px-5 py-4 rounded-2xl hover:bg-zinc-900 transition">

                    <span>🧾</span>

                    <span>SMS History</span>

                </a>

                <a href="/make-call"
                    class="flex items-center gap-4 px-5 py-4 rounded-2xl hover:bg-zinc-900 transition">

                    <span>📞</span>

                    <span>Make Call</span>

                </a>

                <a href="/call-history"
                    class="flex items-center gap-4 px-5 py-4 rounded-2xl hover:bg-zinc-900 transition">

                    <span>📋</span>

                    <span>Call History</span>

                </a>

                <a href="/callerids"
                    class="flex items-center gap-4 px-5 py-4 rounded-2xl hover:bg-zinc-900 transition">

                    <span>🪪</span>

                    <span>Caller IDs</span>

                </a>

                <a href="/senderids"
                    class="flex items-center gap-4 px-5 py-4 rounded-2xl hover:bg-zinc-900 transition">

                    <span>🏷️</span>

                    <span>Sender IDs</span>

                </a>

                <a href="/deposit"
                    class="flex items-center gap-4 px-5 py-4 rounded-2xl hover:bg-zinc-900 transition">

                    <span>💰</span>

                    <span>Deposit</span>

                </a>

            </nav>

            <!-- USER -->
            <div class="absolute bottom-0 left-0 right-0 p-6 border-t border-zinc-800">

                <div class="mb-4">

                    <p class="font-bold">
                        {{ Auth::user()->name }}
                    </p>

                    <p class="text-zinc-400 text-sm">
                        {{ Auth::user()->email }}
                    </p>

                </div>

                <!-- LOGOUT -->
                <form method="POST" action="{{ route('logout') }}">

                    @csrf

                    <button
                        type="submit"
                        class="w-full bg-red-500 hover:bg-red-600 py-3 rounded-2xl font-semibold transition">

                        Logout

                    </button>

                </form>

            </div>

        </aside>

        <!-- MOBILE OVERLAY -->
        <div
            x-show="sidebarOpen"
            @click="sidebarOpen = false"
            class="fixed inset-0 bg-black/70 z-40 lg:hidden">

        </div>

        <!-- MAIN -->
        <div class="flex-1 flex flex-col min-h-screen">

            <!-- TOPBAR -->
            <header class="h-20 border-b border-zinc-800 bg-black flex items-center justify-between px-6">

                <!-- MOBILE BUTTON -->
                <button
                    @click="sidebarOpen = true"
                    class="lg:hidden text-3xl">

                    ☰

                </button>

                <!-- PAGE TITLE -->
                <div class="text-xl font-bold">

                    {{ $header ?? 'MurkyNet Dashboard' }}

                </div>

                <!-- RIGHT -->
                <div class="flex items-center gap-6">

                    <!-- NOTIFICATIONS -->
                    <div class="relative">

                        <button
                            @click="notificationsOpen = ! notificationsOpen"
                            class="relative text-2xl">

                            🔔

                            @if(Auth::user()->unreadNotifications->count() > 0)

                                <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full px-2 py-1">

                                    {{ Auth::user()->unreadNotifications->count() }}

                                </span>

                            @endif

                        </button>

                        <!-- DROPDOWN -->
                        <div
                            x-show="notificationsOpen"
                            @click.away="notificationsOpen = false"
                            x-transition
                            class="absolute right-0 mt-4 w-96 bg-zinc-900 border border-zinc-800 rounded-2xl shadow-2xl overflow-hidden z-50">

                            <div class="p-5 border-b border-zinc-800">

                                <h3 class="text-lg font-bold">
                                    Notifications
                                </h3>

                            </div>

                            <div class="max-h-96 overflow-y-auto">

                                @forelse(Auth::user()->notifications->take(10) as $notification)

                                    <div class="p-5 border-b border-zinc-800 hover:bg-zinc-800 transition">

                                        <p class="font-semibold mb-1">

                                            {{ $notification->data['title'] }}

                                        </p>

                                        <p class="text-sm text-zinc-400">

                                            {{ $notification->data['message'] }}

                                        </p>

                                        <p class="text-xs text-zinc-500 mt-2">

                                            {{ $notification->created_at->diffForHumans() }}

                                        </p>

                                    </div>

                                @empty

                                    <div class="p-6 text-center text-zinc-500">

                                        No notifications found.

                                    </div>

                                @endforelse

                            </div>

                        </div>

                    </div>

                    <!-- USER -->
                    <div class="hidden md:block text-right">

                        <p class="font-semibold">
                            {{ Auth::user()->name }}
                        </p>

                        <p class="text-zinc-500 text-sm">
                            Online
                        </p>

                    </div>

                    <!-- AVATAR -->
                    <div class="w-12 h-12 rounded-full bg-orange-500 flex items-center justify-center font-black text-black">

                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}

                    </div>

                </div>

            </header>

            <!-- CONTENT -->
            <main class="flex-1 p-6 overflow-y-auto">

                {{ $slot }}

            </main>

        </div>

    </div>

</body>

</html>