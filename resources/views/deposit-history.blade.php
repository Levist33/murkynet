<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white leading-tight">
            Deposit History
        </h2>
    </x-slot>

    <div class="min-h-screen bg-black text-white py-10">

        <div class="max-w-6xl mx-auto px-6">

            <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-8">

                <h3 class="text-3xl font-bold mb-8">
                    My Deposits
                </h3>

                <div class="overflow-x-auto">

                    <table class="w-full">

                        <thead>

                            <tr class="border-b border-zinc-800 text-zinc-400 text-left">

                                <th class="pb-4">Currency</th>

                                <th class="pb-4">Network</th>

                                <th class="pb-4">Amount</th>

                                <th class="pb-4">TXID</th>

                                <th class="pb-4">Status</th>

                                <th class="pb-4">Date</th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($deposits as $deposit)

                                <tr class="border-b border-zinc-800">

                                    <td class="py-4">
                                        {{ $deposit->currency }}
                                    </td>

                                    <td class="py-4">
                                        {{ $deposit->network }}
                                    </td>

                                    <td class="py-4 text-orange-400">
                                        ${{ $deposit->amount }}
                                    </td>

                                    <td class="py-4">
                                        {{ $deposit->txid }}
                                    </td>

                                    <td class="py-4">

                                        @if($deposit->status === 'approved')

                                            <span class="bg-green-500/20 text-green-400 px-3 py-1 rounded-full text-sm">
                                                Approved
                                            </span>

                                        @elseif($deposit->status === 'rejected')

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
                                        {{ $deposit->created_at }}
                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="6" class="py-10 text-center text-zinc-500">

                                        No deposits found.

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