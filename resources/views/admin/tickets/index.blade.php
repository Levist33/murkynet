<x-app-layout>

    <x-slot name="header">
        <h2 class="text-3xl font-bold text-white">
            Admin Support Queue
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-10 px-6">

        <div class="bg-zinc-900 border border-zinc-800 rounded-3xl p-8">

            <div class="space-y-6">

                @forelse($tickets as $ticket)

                    <a href="/admin/tickets/{{ $ticket->id }}"
                       class="block border border-zinc-800 rounded-2xl p-6 hover:border-orange-500 transition">

                        <div class="flex justify-between items-center mb-4">

                            <div>

                                <h3 class="text-2xl font-bold">

                                    {{ $ticket->subject }}

                                </h3>

                                <p class="text-zinc-500">

                                    {{ $ticket->user->name }}

                                </p>

                            </div>

                            <span class="bg-green-500/20 text-green-400 px-4 py-2 rounded-full">

                                {{ ucfirst($ticket->status) }}

                            </span>

                        </div>

                        <p class="text-zinc-300">

                            {{ $ticket->message }}

                        </p>

                    </a>

                @empty

                    <div class="text-zinc-500">

                        No tickets found.

                    </div>

                @endforelse

            </div>

        </div>

    </div>

</x-app-layout>