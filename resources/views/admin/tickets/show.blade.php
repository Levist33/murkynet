<x-app-layout>

    <x-slot name="header">
        <h2 class="text-3xl font-bold text-white">
            Ticket Management
        </h2>
    </x-slot>

    <div class="max-w-5xl mx-auto py-10 px-6">

        @if(session('success'))

            <div class="bg-green-500/20 text-green-400 p-4 rounded-2xl mb-8">

                {{ session('success') }}

            </div>

        @endif

        <!-- Ticket -->

        <div class="bg-zinc-900 border border-zinc-800 rounded-3xl p-8 mb-8">

            <div class="flex justify-between items-center mb-6">

                <div>

                    <h1 class="text-3xl font-bold">

                        {{ $ticket->subject }}

                    </h1>

                    <p class="text-zinc-500 mt-2">

                        {{ $ticket->user->name }}

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

            @foreach($ticket->replies as $reply)

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

                    <p class="text-zinc-300">

                        {{ $reply->message }}

                    </p>

                </div>

            @endforeach

        </div>

        <!-- Reply -->

        <div class="bg-zinc-900 border border-zinc-800 rounded-3xl p-8">

            <form method="POST"
                  action="/admin/tickets/{{ $ticket->id }}/reply">

                @csrf

                <textarea
                    name="message"
                    rows="6"
                    class="w-full bg-black border border-zinc-700 rounded-2xl p-4 text-white mb-6"></textarea>

                <button
                    class="bg-orange-500 hover:bg-orange-600 px-8 py-4 rounded-2xl font-bold">

                    Send Admin Reply

                </button>

            </form>

            <form method="POST"
                  action="/admin/tickets/{{ $ticket->id }}/close"
                  class="mt-6">

                @csrf

                <button
                    class="bg-red-500 hover:bg-red-600 px-8 py-4 rounded-2xl font-bold">

                    Close Ticket

                </button>

            </form>

        </div>

    </div>

</x-app-layout>