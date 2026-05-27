<x-app-layout>

    <x-slot name="header">
        <h2 class="text-3xl font-bold text-white">
            Ticket Conversation
        </h2>
    </x-slot>

    <div class="max-w-5xl mx-auto py-10 px-6">

        <!-- Ticket -->

        <div class="bg-zinc-900 border border-zinc-800 rounded-3xl p-8 mb-8">

            <div class="flex justify-between items-center mb-6">

                <div>

                    <h1 class="text-3xl font-bold">

                        {{ $ticket->subject }}

                    </h1>

                    <p class="text-zinc-500 mt-2">

                        {{ ucfirst($ticket->category) }}

                    </p>

                </div>

                <span class="bg-green-500/20 text-green-400 px-4 py-2 rounded-full">

                    {{ ucfirst($ticket->status) }}

                </span>

            </div>

            <div class="bg-black rounded-2xl p-6 border border-zinc-800">

                {{ $ticket->message }}

            </div>

        </div>

        <!-- Replies -->

        <div class="space-y-6 mb-8">

            @forelse($ticket->replies as $reply)

                <div class="bg-zinc-900 border border-zinc-800 rounded-3xl p-6">

                    <div class="flex justify-between items-center mb-4">

                        <div>

                            <h4 class="font-bold">

                                {{ $reply->user->name }}

                            </h4>

                            <p class="text-zinc-500 text-sm">

                                {{ $reply->created_at->diffForHumans() }}

                            </p>

                        </div>

                        @if($reply->is_admin)

                            <span class="bg-orange-500/20 text-orange-400 px-3 py-1 rounded-full text-sm">

                                Admin

                            </span>

                        @endif

                    </div>

                    <p class="text-zinc-300 leading-relaxed">

                        {{ $reply->message }}

                    </p>

                </div>

            @empty

                <div class="text-zinc-500">

                    No replies yet.

                </div>

            @endforelse

        </div>

        <!-- Reply Form -->

        <div class="bg-zinc-900 border border-zinc-800 rounded-3xl p-8">

            <h3 class="text-2xl font-bold mb-6">
                Send Reply
            </h3>

            <form method="POST"
                  action="/tickets/{{ $ticket->id }}/reply">

                @csrf

                <textarea
                    name="message"
                    rows="6"
                    class="w-full bg-black border border-zinc-700 rounded-2xl p-4 text-white mb-6"></textarea>

                <button
                    class="bg-orange-500 hover:bg-orange-600 px-8 py-4 rounded-2xl font-bold">

                    Send Reply

                </button>

            </form>

        </div>

    </div>

</x-app-layout>