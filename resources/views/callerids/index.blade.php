<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white leading-tight">
            Caller IDs
        </h2>
    </x-slot>

    <div class="min-h-screen bg-black text-white py-10">

        <div class="max-w-6xl mx-auto px-6">

            <!-- Request Form -->

            <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-8 mb-10">

                <h3 class="text-3xl font-bold mb-8">
                    Request Caller ID
                </h3>

                @if(session('success'))

                    <div class="bg-green-500/20 border border-green-500 text-green-400 p-4 rounded-xl mb-6">
                        {{ session('success') }}
                    </div>

                @endif

                @if ($errors->any())

                    <div class="bg-red-500/20 border border-red-500 text-red-400 p-4 rounded-xl mb-6">

                        <ul class="list-disc ml-5">

                            @foreach ($errors->all() as $error)

                                <li>{{ $error }}</li>

                            @endforeach

                        </ul>

                    </div>

                @endif

                <form method="POST" action="/callerids" class="space-y-6">

                    @csrf

                    <div>

                        <label class="block mb-3 text-zinc-400">
                            Caller ID Number
                        </label>

                        <input
                            type="text"
                            name="caller_id"
                            placeholder="+14155550123"
                            class="w-full bg-black border border-zinc-700 rounded-xl p-5 text-white">

                    </div>

                    <button
                        type="submit"
                        class="bg-orange-500 hover:bg-orange-600 px-8 py-4 rounded-xl font-bold">

                        Submit Caller ID

                    </button>

                </form>

            </div>

            <!-- Caller ID History -->

            <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-8">

                <h3 class="text-3xl font-bold mb-8">
                    My Caller IDs
                </h3>

                <div class="overflow-x-auto">

                    <table class="w-full">

                        <thead>

                            <tr class="border-b border-zinc-800 text-left text-zinc-400">

                                <th class="pb-4">
                                    Caller ID
                                </th>

                                <th class="pb-4">
                                    Status
                                </th>

                                <th class="pb-4">
                                    Created
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($callerIds as $callerId)

                                <tr class="border-b border-zinc-800">

                                    <td class="py-5">
                                        {{ $callerId->caller_id }}
                                    </td>

                                    <td class="py-5">

                                        @if($callerId->status === 'approved')

                                            <span class="bg-green-500/20 text-green-400 px-3 py-1 rounded-full text-sm">
                                                Approved
                                            </span>

                                        @elseif($callerId->status === 'rejected')

                                            <span class="bg-red-500/20 text-red-400 px-3 py-1 rounded-full text-sm">
                                                Rejected
                                            </span>

                                        @else

                                            <span class="bg-yellow-500/20 text-yellow-400 px-3 py-1 rounded-full text-sm">
                                                Pending
                                            </span>

                                        @endif

                                    </td>

                                    <td class="py-5 text-zinc-400">
                                        {{ $callerId->created_at }}
                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="3" class="py-10 text-center text-zinc-500">

                                        No caller IDs submitted yet.

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