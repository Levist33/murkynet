<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white leading-tight">
            Call History
        </h2>
    </x-slot>

    <div class="min-h-screen bg-black text-white py-10">

        <div class="max-w-7xl mx-auto px-6">

            <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-8">

                <h3 class="text-3xl font-bold mb-8">
                    Call Logs
                </h3>

                <div class="overflow-x-auto">

                    <table class="w-full">

                        <thead>

                            <tr class="border-b border-zinc-800 text-zinc-400 text-left">

                                <th class="pb-4">Caller ID</th>

                                <th class="pb-4">Phone</th>

                                <th class="pb-4">Duration</th>

                                <th class="pb-4">Cost</th>

                                <th class="pb-4">Status</th>

                                <th class="pb-4">Date</th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($callLogs as $call)

                                <tr class="border-b border-zinc-800">

                                    <td class="py-4">

                                        {{ optional($call->callerId)->caller_id }}

                                    </td>

                                    <td class="py-4">

                                        {{ $call->phone }}

                                    </td>

                                    <td class="py-4">

                                        {{ $call->duration }} sec

                                    </td>

                                    <td class="py-4 text-orange-400">

                                        ${{ $call->cost }}

                                    </td>

                                    <td class="py-4">

                                        @if($call->status === 'completed')

                                            <span class="bg-green-500/20 text-green-400 px-3 py-1 rounded-full text-sm">
                                                Completed
                                            </span>

                                        @elseif($call->status === 'failed')

                                            <span class="bg-red-500/20 text-red-400 px-3 py-1 rounded-full text-sm">
                                                Failed
                                            </span>

                                        @elseif($call->status === 'answered')

                                            <span class="bg-blue-500/20 text-blue-400 px-3 py-1 rounded-full text-sm">
                                                Answered
                                            </span>

                                        @else

                                            <span class="bg-yellow-500/20 text-yellow-400 px-3 py-1 rounded-full text-sm">
                                                Ringing
                                            </span>

                                        @endif

                                    </td>

                                    <td class="py-4 text-zinc-400">

                                        {{ $call->created_at }}

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="6" class="py-10 text-center text-zinc-500">

                                        No call logs found.

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