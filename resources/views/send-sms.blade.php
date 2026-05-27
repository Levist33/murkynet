<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white leading-tight">
            Send SMS
        </h2>
    </x-slot>

    <div class="min-h-screen bg-black text-white py-10">

        <div class="max-w-3xl mx-auto px-6">

            <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-8">

                <h3 class="text-3xl font-bold mb-8">
                    Bulk SMS
                </h3>

                @if(session('success'))

                    <div class="bg-green-500/20 text-green-400 p-4 rounded-xl mb-6">
                        {{ session('success') }}
                    </div>

                @endif

                @if(session('error'))

                    <div class="bg-red-500/20 text-red-400 p-4 rounded-xl mb-6">
                        {{ session('error') }}
                    </div>

                @endif

                <form method="POST" action="/send-sms" class="space-y-6">

                    @csrf

                    <!-- Country -->

                    <div>

                        <label class="block mb-2 text-zinc-400">
                            Country
                        </label>

                        <input
                            type="text"
                            name="country"
                            placeholder="e.g Nigeria"
                            class="w-full bg-black border border-zinc-700 rounded-xl p-4">

                    </div>

                    <!-- Recipient -->

                    <div>

                        <label class="block mb-2 text-zinc-400">
                            Recipient
                        </label>

                        <input
                            type="text"
                            name="recipient"
                            placeholder="+234xxxxxxxx"
                            class="w-full bg-black border border-zinc-700 rounded-xl p-4">

                    </div>

                    <!-- Message -->

                    <div>

                        <label class="block mb-2 text-zinc-400">
                            Message
                        </label>

                        <textarea
                            name="message"
                            rows="5"
                            placeholder="Enter SMS content..."
                            class="w-full bg-black border border-zinc-700 rounded-xl p-4"></textarea>

                    </div>

                    <!-- Submit -->

                    <button
                        type="submit"
                        class="bg-orange-500 hover:bg-orange-600 px-6 py-4 rounded-xl font-semibold">

                        Send SMS

                    </button>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>