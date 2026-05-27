<nav x-data="{ open: false }" class="bg-black border-b border-zinc-800">

    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex justify-between h-16">

            <!-- Left Side -->
            <div class="flex items-center">

                <!-- Brand -->
                <div class="shrink-0 flex items-center">

                    <a href="{{ url('/dashboard-ui') }}"
                       class="text-2xl font-bold text-orange-500">

                        MurkyNet

                    </a>

                </div>

                <!-- Navigation Links -->
                <div class="hidden sm:flex space-x-8 ms-10">

                    <x-nav-link :href="url('/dashboard-ui')">
                        Dashboard
                    </x-nav-link>

                    <x-nav-link :href="url('/send-sms')">
                        SMS
                    </x-nav-link>

                    <x-nav-link :href="url('/sms-history')">
                        SMS Logs
                    </x-nav-link>

                    <x-nav-link :href="url('/callerids')">
                        Caller IDs
                    </x-nav-link>

                    <x-nav-link :href="url('/make-call')">
                        Calls
                    </x-nav-link>

                    <x-nav-link :href="url('/call-history')">
                        Call Logs
                    </x-nav-link>

                    <x-nav-link :href="url('/deposit')">
                        Deposit
                    </x-nav-link>

                </div>

            </div>

            <!-- Right Side -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">

                <x-dropdown align="right" width="48">

                    <x-slot name="trigger">

                        <button class="inline-flex items-center px-4 py-2 rounded-xl bg-zinc-900 border border-zinc-700 text-white hover:bg-zinc-800 transition">

                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-2">

                                <svg class="fill-current h-4 w-4"
                                     xmlns="http://www.w3.org/2000/svg"
                                     viewBox="0 0 20 20">

                                    <path fill-rule="evenodd"
                                          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                          clip-rule="evenodd" />

                                </svg>

                            </div>

                        </button>

                    </x-slot>

                    <x-slot name="content">

                        <x-dropdown-link :href="url('/dashboard-ui')">
                            Profile
                        </x-dropdown-link>

                        <!-- Logout -->

                        <form method="POST" action="{{ route('logout') }}">

                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                this.closest('form').submit();">

                                Log Out

                            </x-dropdown-link>

                        </form>

                    </x-slot>

                </x-dropdown>

            </div>

            <!-- Mobile Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">

                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-zinc-400 hover:text-white hover:bg-zinc-800 focus:outline-none transition">

                    <svg class="h-6 w-6"
                         stroke="currentColor"
                         fill="none"
                         viewBox="0 0 24 24">

                        <path :class="{'hidden': open, 'inline-flex': ! open }"
                              class="inline-flex"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />

                        <path :class="{'hidden': ! open, 'inline-flex': open }"
                              class="hidden"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />

                    </svg>

                </button>

            </div>

        </div>

    </div>

    <!-- Responsive Mobile Menu -->

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-black border-t border-zinc-800">

        <div class="pt-2 pb-3 space-y-1 px-4">

            <x-responsive-nav-link :href="url('/dashboard-ui')">
                Dashboard
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="url('/send-sms')">
                SMS
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="url('/callerids')">
                Caller IDs
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="url('/make-call')">
                Calls
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="url('/deposit')">
                Deposit
            </x-responsive-nav-link>

        </div>

        <!-- Mobile User -->

        <div class="pt-4 pb-4 border-t border-zinc-800 px-4">

            <div class="text-white font-semibold">
                {{ Auth::user()->name }}
            </div>

            <div class="text-zinc-400 text-sm">
                {{ Auth::user()->email }}
            </div>

            <form method="POST"
                  action="{{ route('logout') }}"
                  class="mt-4">

                @csrf

                <button
                    type="submit"
                    class="text-red-400 hover:text-red-500">

                    Log Out

                </button>

            </form>

        </div>

    </div>

</nav>