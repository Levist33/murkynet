<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white leading-tight">
            Outbound Calling
        </h2>
    </x-slot>

    <div class="min-h-screen bg-black text-white py-10">

        <div class="max-w-3xl mx-auto px-6">

            <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-8">

                <h3 class="text-3xl font-bold mb-8">
                    Make Outbound Call
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

                <form method="POST" action="/make-call" class="space-y-6">

                    @csrf

                    <div>

                        <label class="block mb-2 text-zinc-400">
                            Select Caller ID
                        </label>

                        <select
                            name="caller_id"
                            class="w-full bg-black border border-zinc-700 rounded-xl p-4">

                            @foreach($callerIds as $callerId)

                                <option value="{{ $callerId->id }}">

                                    {{ $callerId->caller_id }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div>

                        <label class="block mb-2 text-zinc-400">
                            Destination Number
                        </label>

                        <input
                            type="text"
                            name="phone"
                            placeholder="e.g +14155550123"
                            class="w-full bg-black border border-zinc-700 rounded-xl p-4">

                    </div>

                    <div class="bg-black border border-zinc-800 rounded-xl p-4">

                        <div class="flex justify-between">

                            <span class="text-zinc-400">
                                Call Rate
                            </span>

                            <span class="text-orange-400">
                                $0.20 / call
                            </span>

                        </div>

                    </div>

                    <button
                        type="submit"
                        class="bg-orange-500 hover:bg-orange-600 px-6 py-4 rounded-xl font-semibold">

                        Initiate Call

                    </button>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>