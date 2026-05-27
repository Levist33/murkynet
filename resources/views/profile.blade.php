<x-app-layout>

    <div class="min-h-screen bg-black text-white p-6">

        <div class="max-w-4xl mx-auto">

            <h1 class="text-4xl font-bold mb-8">
                Account Settings
            </h1>

            <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-8">

                <div class="flex items-center gap-6 mb-10">

                    <div class="w-20 h-20 rounded-full bg-orange-500 flex items-center justify-center text-3xl font-bold text-black">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>

                    <div>

                        <h2 class="text-2xl font-bold">
                            {{ Auth::user()->name }}
                        </h2>

                        <p class="text-zinc-400">
                            {{ Auth::user()->email }}
                        </p>

                    </div>

                </div>

                <form method="POST" action="/user/profile-information">

                    @csrf
                    @method('PATCH')

                    <div class="mb-6">

                        <label class="block mb-2 text-zinc-400">
                            Full Name
                        </label>

                        <input
                            type="text"
                            name="name"
                            value="{{ Auth::user()->name }}"
                            class="w-full bg-black border border-zinc-700 rounded-xl p-4">

                    </div>

                    <div class="mb-6">

                        <label class="block mb-2 text-zinc-400">
                            Email Address
                        </label>

                        <input
                            type="email"
                            name="email"
                            value="{{ Auth::user()->email }}"
                            class="w-full bg-black border border-zinc-700 rounded-xl p-4">

                    </div>

                    <button
                        class="bg-orange-500 hover:bg-orange-600 px-6 py-4 rounded-xl font-semibold">

                        Update Profile

                    </button>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>