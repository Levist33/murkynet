<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white leading-tight">
            SMS History
        </h2>
    </x-slot>

    <div class="min-h-screen bg-black text-white py-10">

        <div class="max-w-7xl mx-auto px-6">

            <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-8">

                <h3 class="text-3xl font-bold mb-8">
                    SMS Logs
                </h3>

                <div class="overflow-x-auto">

                    <table class="w-full">

                        <thead>

                            <tr class="border-b border-zinc-800 text-zinc-400 text-left">

                                <th class="pb-4">Sender ID</th>

                                <th class="pb-4">Phone</th>

                                <th class="pb-4">Message</th>

                                <th class="pb-4">Cost</th>

                                <th class="pb-4">Status</th>

                                <th class="pb-4">Date</th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($smsLogs as $sms)

                                <tr class="border-b border-zinc-800">

                                    <td class="py-4">

                                        {{ optional($sms->senderid)->sender_id }}

                                    </td>

                                    <td class="py-4">

                                        {{ $sms->phone }}

                                    </td>

                                    <td class="py-4 max-w-xs truncate">

                                        {{ $sms->message }}

                                    </td>

                                    <td class="py-4 text-orange-400">

                                        ${{ $sms->cost }}

                                    </td>

                                    <td class="py-4">

                                        @if($sms->status === 'sent')

                                            <span class="bg-green-500/20 text-green-400 px-3 py-1 rounded-full text-sm">
                                                Sent
                                            </span>

                                        @elseif($sms->status === 'failed')

                                            <span class="bg-red-500/20 text-red-400 px-3 py-1 rounded-full text-sm">
                                                Failed
                                            </span>

                                        @else

                                            <span class="bg-yellow-500/20 text-yellow-400 px-3 py-1 rounded-full text-sm">
                                                Pending
                                            </span>

                                        @endif

                                    </td>

                                    <td class="py-4 text-zinc-400">

                                        {{ $sms->created_at }}

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="6" class="py-10 text-center text-zinc-500">

                                        No SMS logs found.

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