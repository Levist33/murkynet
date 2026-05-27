<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white leading-tight">
            Sender IDs
        </h2>
    </x-slot>

    <div class="min-h-screen bg-black text-white py-10">

        <div class="max-w-5xl mx-auto px-6">

            <!-- Request Form -->

            <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-8 mb-10">

                <h3 class="text-3xl font-bold mb-8">
                    Request Sender ID
                </h3>

                @if(session('success'))

                    <div class="bg-green-500/20 text-green-400 p-4 rounded-xl mb-6">
                        {{ session('success') }}
                    </div>

                @endif

                <form method="POST" action="/senderids" class="space-y-6">

                    @csrf

                    <div>

                        <label class="block mb-2 text-zinc-400">
                            Sender ID
                        </label>

                        <input
                            type="text"
                            name="sender_id"
                            maxlength="11"
                            placeholder="e.g MYBRAND"
                            class="w-full bg-black border border-zinc-700 rounded-xl p-4">

                    </div>

                    <button
                        type="submit"
                        class="bg-orange-500 hover:bg-orange-600 px-6 py-4 rounded-xl font-semibold">

                        Submit Sender ID

                    </button>

                </form>

            </div>

            <!-- Sender ID History -->

            <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-8">

                <h3 class="text-3xl font-bold mb-8">
                    My Sender IDs
                </h3>

                <div class="overflow-x-auto">

                    <table class="w-full">

                        <thead>

                            <tr class="border-b border-zinc-800 text-zinc-400 text-left">

                                <th class="pb-4">Sender ID</th>

                                <th class="pb-4">Status</th>

                                <th class="pb-4">Date</th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($senderids as $senderid)

                                <tr class="border-b border-zinc-800">

                                    <td class="py-4 font-semibold">
                                        {{ $senderid->sender_id }}
                                    </td>

                                    <td class="py-4">

                                        @if($senderid->status === 'approved')

                                            <span class="bg-green-500/20 text-green-400 px-3 py-1 rounded-full text-sm">
                                                Approved
                                            </span>

                                        @elseif($senderid->status === 'rejected')

                                            <span class="bg-red-500/20 text-red-400 px-3 py-1 rounded-full text-sm">
                                                Rejected
                                            </span>

                                        @else

                                            <span class="bg-yellow-500/20 text-yellow-400 px-3 py-1 rounded-full text-sm">
                                                Pending
                                            </span>

                                        @endif

                                    </td>

                                    <td class="py-4 text-zinc-400">
                                        {{ $senderid->created_at }}
                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="3" class="py-10 text-center text-zinc-500">

                                        No Sender IDs found.

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>