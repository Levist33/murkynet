<x-app-layout>

    <x-slot name="header">
        <h2 class="text-3xl font-bold text-white">
            Support Center
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-10 px-6">

        @if(session('success'))

            <div class="bg-green-500/20 text-green-400 p-4 rounded-2xl mb-8">

                {{ session('success') }}

            </div>

        @endif

        <!-- Open Ticket -->

        <div class="bg-zinc-900 border border-zinc-800 rounded-3xl p-8 mb-10">

            <h3 class="text-2xl font-bold mb-8">
                Open Support Ticket
            </h3>

            <form method="POST" action="/tickets">

                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">

                    <div>

                        <label class="block mb-2 text-zinc-400">
                            Subject
                        </label>

                        <input
                            type="text"
                            name="subject"
                            class="w-full bg-black border border-zinc-700 rounded-2xl p-4 text-white">

                    </div>

                    <div>

                        <label class="block mb-2 text-zinc-400">
                            Category
                        </label>

                        <select
                            name="category"
                            class="w-full bg-black border border-zinc-700 rounded-2xl p-4 text-white">

                            <option value="sms">
                                SMS
                            </option>

                            <option value="calls">
                                Calls
                            </option>

                            <option value="billing">
                                Billing
                            </option>

                            <option value="technical">
                                Technical
                            </option>

                        </select>

                    </div>

                </div>

                <div class="mb-6">

                    <label class="block mb-2 text-zinc-400">
                        Message
                    </label>

                    <textarea
                        name="message"
                        rows="6"
                        class="w-full bg-black border border-zinc-700 rounded-2xl p-4 text-white"></textarea>

                </div>

                <button
                    class="bg-orange-500 hover:bg-orange-600 px-8 py-4 rounded-2xl font-bold">

                    Submit Ticket

                </button>

            </form>

        </div>

        <!-- Ticket List -->

        <div class="bg-zinc-900 border border-zinc-800 rounded-3xl p-8">

            <h3 class="text-2xl font-bold mb-8">
                Your Tickets
            </h3>

            <div class="space-y-6">

                @forelse($tickets as $ticket)

                    <a href="/tickets/{{ $ticket->id }}"
                       class="block border border-zinc-800 rounded-2xl p-6 hover:border-orange-500 transition">

                        <div class="flex justify-between items-center mb-4">

                            <div>

                                <h4 class="text-xl font-bold">

                                    {{ $ticket->subject }}

                                </h4>

                                <p class="text-zinc-500 text-sm">

                                    {{ ucfirst($ticket->category) }}

                                </p>

                            </div>

                            <span class="bg-green-500/20 text-green-400 px-4 py-2 rounded-full text-sm">

                                {{ ucfirst($ticket->status) }}

                            </span>

                        </div>

                        <p class="text-zinc-300 leading-relaxed">

                            {{ $ticket->message }}

                        </p>

                        <p class="text-zinc-500 text-sm mt-4">

                            {{ $ticket->created_at->diffForHumans() }}

                        </p>

                    </a>

                @empty

                    <div class="text-zinc-500">

                        No support tickets yet.

                    </div>

                @endforelse

            </div>

        </div>

    </div>

</x-app-layout>