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

        <!-- Register Card -->

        <div class="bg-zinc-900 border border-zinc-800 rounded-3xl p-10 shadow-2xl">

            <h2 class="text-3xl font-bold text-white mb-8 text-center">
                Create Your Account
            </h2>

            <form method="POST" action="{{ route('register') }}">

                @csrf

                <!-- Name -->

                <div class="mb-6">

                    <x-input-label
                        for="name"
                        :value="__('Full Name')"
                        class="text-zinc-300 mb-2" />

                    <x-text-input
                        id="name"
                        class="block mt-1 w-full bg-black border border-zinc-700 text-white rounded-xl p-4 focus:border-orange-500 focus:ring-orange-500"
                        type="text"
                        name="name"
                        :value="old('name')"
                        required
                        autofocus
                        autocomplete="name" />

                    <x-input-error
                        :messages="$errors->get('name')"
                        class="mt-2 text-red-400" />

                </div>

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
                        autocomplete="new-password" />

                    <x-input-error
                        :messages="$errors->get('password')"
                        class="mt-2 text-red-400" />

                </div>

                <!-- Confirm Password -->

                <div class="mb-8">

                    <x-input-label
                        for="password_confirmation"
                        :value="__('Confirm Password')"
                        class="text-zinc-300 mb-2" />

                    <x-text-input
                        id="password_confirmation"
                        class="block mt-1 w-full bg-black border border-zinc-700 text-white rounded-xl p-4 focus:border-orange-500 focus:ring-orange-500"
                        type="password"
                        name="password_confirmation"
                        required
                        autocomplete="new-password" />

                    <x-input-error
                        :messages="$errors->get('password_confirmation')"
                        class="mt-2 text-red-400" />

                </div>

                <!-- Register Button -->

                <button
                    type="submit"
                    class="w-full bg-orange-500 hover:bg-orange-600 transition text-white font-bold py-4 rounded-2xl text-lg">

                    Create Account

                </button>

                <!-- Login Link -->

                <div class="text-center mt-8">

                    <p class="text-zinc-400">

                        Already have an account?

                        <a href="{{ route('login') }}"
                           class="text-orange-400 hover:text-orange-500 font-semibold">

                            Login

                        </a>

                    </p>

                </div>

            </form>

        </div>

    </div>

</x-guest-layout>