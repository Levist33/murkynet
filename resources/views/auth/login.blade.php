<x-guest-layout>

    <div class="w-full max-w-md">

        <!-- Brand -->

        <div class="text-center mb-10">

            <h1 class="text-5xl font-extrabold text-orange-500 mb-3">
                MurkyNet
            </h1>

            <p class="text-zinc-400 text-lg">
                Telecom SaaS Platform
            </p>

        </div>

        <!-- Session Status -->

        <x-auth-session-status
            class="mb-6"
            :status="session('status')" />

        <!-- Login Card -->

        <div class="bg-zinc-900 border border-zinc-800 rounded-3xl p-10 shadow-2xl">

            <h2 class="text-3xl font-bold text-white mb-8 text-center">
                Login to Your Account
            </h2>

            <form method="POST" action="{{ route('login') }}">

                @csrf

                <!-- Email -->

                <div class="mb-6">

                    <x-input-label
                        for="email"
                        :value="__('Email Address')"
                        class="text-zinc-300 mb-2" />

                    <x-text-input
                        id="email"
                        class="block mt-1 w-full bg-black border border-zinc-700 text-white rounded-xl p-4 focus:border-orange-500 focus:ring-orange-500"
                        type="email"
                        name="email"
                        :value="old('email')"
                        required
                        autofocus
                        autocomplete="username" />

                    <x-input-error
                        :messages="$errors->get('email')"
                        class="mt-2 text-red-400" />

                </div>

                <!-- Password -->

                <div class="mb-6">

                    <x-input-label
                        for="password"
                        :value="__('Password')"
                        class="text-zinc-300 mb-2" />

                    <x-text-input
                        id="password"
                        class="block mt-1 w-full bg-black border border-zinc-700 text-white rounded-xl p-4 focus:border-orange-500 focus:ring-orange-500"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password" />

                    <x-input-error
                        :messages="$errors->get('password')"
                        class="mt-2 text-red-400" />

                </div>

                <!-- Remember Me -->

                <div class="flex items-center justify-between mb-8">

                    <label for="remember_me" class="inline-flex items-center">

                        <input
                            id="remember_me"
                            type="checkbox"
                            class="rounded border-zinc-700 bg-black text-orange-500 focus:ring-orange-500"
                            name="remember">

                        <span class="ms-2 text-sm text-zinc-400">
                            Remember me
                        </span>

                    </label>

                    @if (Route::has('password.request'))

                        <a
                            class="text-sm text-orange-400 hover:text-orange-500 transition"
                            href="{{ route('password.request') }}">

                            Forgot password?

                        </a>

                    @endif

                </div>

                <!-- Login Button -->

                <button
                    type="submit"
                    class="w-full bg-orange-500 hover:bg-orange-600 transition text-white font-bold py-4 rounded-2xl text-lg">

                    Log In

                </button>

                <!-- Register Link -->

                <div class="text-center mt-8">

                    <p class="text-zinc-400">

                        Don’t have an account?

                        <a href="{{ route('register') }}"
                           class="text-orange-400 hover:text-orange-500 font-semibold">

                            Create Account

                        </a>

                    </p>

                </div>

            </form>

        </div>

    </div>

</x-guest-layout>