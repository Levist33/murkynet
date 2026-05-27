<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-white leading-tight">
            MurkyNet Dashboard
        </h2>
    </x-slot>

    <div class="min-h-screen bg-black text-white py-10">

        <div class="max-w-7xl mx-auto px-6">

            <!-- Welcome -->

            <div class="mb-10">

                <h1 class="text-5xl font-bold mb-3">
                    Welcome back, {{ auth()->user()->name }}
                </h1>

                <p class="text-zinc-400 text-lg">
                    Manage your telecom operations, SMS campaigns,
                    wallet funding, and outbound calling infrastructure.
                </p>

            </div>

            <!-- Quick Actions -->

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-10">

                <a href="/send-sms"
                   class="bg-orange-500 hover:bg-orange-600 transition rounded-2xl p-6 font-bold text-lg text-center">

                    Send SMS

                </a>

                <a href="/make-call"
                   class="bg-zinc-900 hover:bg-zinc-800 border border-zinc-800 transition rounded-2xl p-6 font-bold text-lg text-center">

                    Make Call

                </a>

                <a href="/deposit"
                   class="bg-zinc-900 hover:bg-zinc-800 border border-zinc-800 transition rounded-2xl p-6 font-bold text-lg text-center">

                    Fund Wallet

                </a>

                <a href="/senderids"
                   class="bg-zinc-900 hover:bg-zinc-800 border border-zinc-800 transition rounded-2xl p-6 font-bold text-lg text-center">

                    Sender IDs

                </a>

            </div>

            <!-- Analytics Cards -->

            <div class="grid grid-cols-1 md:grid-cols-5 gap-6 mb-10">

                <!-- Wallet -->

                <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-6">

                    <p class="text-zinc-400 mb-3">
                        Wallet Balance
                    </p>

                    <h3 class="text-4xl font-bold text-orange-500">
                        ${{ number_format($wallet->balance, 2) }}
                    </h3>

                </div>

                <!-- SMS Count -->

                <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-6">

                    <p class="text-zinc-400 mb-3">
                        SMS Sent
                    </p>

                    <h3 class="text-4xl font-bold">
                        {{ $smsCount }}
                    </h3>

                </div>

                <!-- Delivered -->

                <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-6">

                    <p class="text-zinc-400 mb-3">
                        Delivered
                    </p>

                    <h3 class="text-4xl font-bold text-green-400">
                        {{ $delivered }}
                    </h3>

                </div>

                <!-- Calls -->

                <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-6">

                    <p class="text-zinc-400 mb-3">
                        Calls Made
                    </p>

                    <h3 class="text-4xl font-bold">
                        {{ $callCount }}
                    </h3>

                </div>

                <!-- Deposits -->

                <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-6">

                    <p class="text-zinc-400 mb-3">
                        Deposits
                    </p>

                    <h3 class="text-4xl font-bold text-blue-400">
                        {{ $depositCount }}
                    </h3>

                </div>

            </div>

            <!-- Delivery Metrics -->

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">

                <!-- SMS Delivery Rate -->

                <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-8">

                    <h3 class="text-2xl font-bold mb-6">
                        SMS Delivery Rate
                    </h3>

                    <div class="w-full bg-zinc-800 rounded-full h-5 mb-4">

                        <div
                            class="bg-green-500 h-5 rounded-full"
                            style="width: {{ $deliveryRate }}%">

                        </div>

                    </div>

                    <p class="text-green-400 text-3xl font-bold">
                        {{ $deliveryRate }}%
                    </p>

                </div>

                <!-- Call Completion -->

                <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-8">

                    <h3 class="text-2xl font-bold mb-6">
                        Completed Calls
                    </h3>

                    <p class="text-5xl font-bold text-orange-500">
                        {{ $completedCalls }}
                    </p>

                </div>

            </div>

            <!-- Analytics Charts -->

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-10">

                <!-- SMS Chart -->

                <div class="bg-zinc-900 border border-zinc-800 rounded-3xl p-6">

                    <h3 class="text-2xl font-bold mb-6">
                        SMS Analytics
                    </h3>

                    <div id="smsChart"></div>

                </div>

                <!-- Calls Chart -->

                <div class="bg-zinc-900 border border-zinc-800 rounded-3xl p-6">

                    <h3 class="text-2xl font-bold mb-6">
                        Calls Analytics
                    </h3>

                    <div id="callChart"></div>

                </div>

                <!-- Deposits Chart -->

                <div class="bg-zinc-900 border border-zinc-800 rounded-3xl p-6">

                    <h3 class="text-2xl font-bold mb-6">
                        Deposit Analytics
                    </h3>

                    <div id="depositChart"></div>

                </div>

            </div>

            <!-- Recent Transactions -->

            <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-8 mb-10">

                <div class="flex items-center justify-between mb-8">

                    <h3 class="text-3xl font-bold">
                        Recent Transactions
                    </h3>

                </div>

                <div class="space-y-5">

                    @forelse($transactions as $transaction)

                        <div class="flex justify-between items-center border-b border-zinc-800 pb-5">

                            <div>

                                <p class="font-semibold text-lg">
                                    {{ $transaction->description }}
                                </p>

                                <p class="text-zinc-400 text-sm">
                                    {{ $transaction->created_at }}
                                </p>

                            </div>

                            <div class="text-orange-500 text-xl font-bold">
                                ${{ number_format($transaction->amount, 2) }}
                            </div>

                        </div>

                    @empty

                        <p class="text-zinc-500">
                            No transactions available.
                        </p>

                    @endforelse

                </div>

            </div>

            <!-- Logs Section -->

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-10">

                <!-- SMS Logs -->

                <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-8">

                    <h3 class="text-3xl font-bold mb-8">
                        Recent SMS Logs
                    </h3>

                    <div class="space-y-5">

                        @forelse($smsLogs as $sms)

                            <div class="border-b border-zinc-800 pb-5">

                                <div class="flex justify-between items-center mb-2">

                                    <span class="font-semibold">
                                        {{ $sms->phone_number }}
                                    </span>

                                    <span class="text-orange-400 font-bold">
                                        ${{ $sms->cost }}
                                    </span>

                                </div>

                                <p class="text-zinc-400 text-sm mb-2">
                                    {{ $sms->message }}
                                </p>

                                <div class="flex justify-between items-center">

                                    <span class="bg-green-500/20 text-green-400 px-3 py-1 rounded-full text-xs">
                                        {{ $sms->status }}
                                    </span>

                                    <span class="text-zinc-500 text-xs">
                                        {{ $sms->created_at }}
                                    </span>

                                </div>

                            </div>

                        @empty

                            <p class="text-zinc-500">
                                No SMS logs found.
                            </p>

                        @endforelse

                    </div>

                </div>

                <!-- Call Logs -->

                <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-8">

                    <h3 class="text-3xl font-bold mb-8">
                        Recent Call Logs
                    </h3>

                    <div class="space-y-5">

                        @forelse($callLogs as $call)

                            <div class="border-b border-zinc-800 pb-5">

                                <div class="flex justify-between items-center mb-2">

                                    <span class="font-semibold">
                                        {{ $call->phone }}
                                    </span>

                                    <span class="text-orange-400 font-bold">
                                        ${{ $call->cost }}
                                    </span>

                                </div>

                                <div class="flex justify-between items-center">

                                    <span class="bg-blue-500/20 text-blue-400 px-3 py-1 rounded-full text-xs">
                                        {{ $call->status }}
                                    </span>

                                    <span class="text-zinc-500 text-xs">
                                        {{ $call->duration }} sec
                                    </span>

                                </div>

                            </div>

                        @empty

                            <p class="text-zinc-500">
                                No call logs found.
                            </p>

                        @endforelse

                    </div>

                </div>

            </div>

            <!-- Live Activity Feed -->

            <div class="bg-zinc-900 border border-zinc-800 rounded-3xl p-8">

                <div class="flex items-center justify-between mb-8">

                    <h2 class="text-3xl font-bold">
                        Live Activity Feed
                    </h2>

                    <span class="text-green-400 text-sm">
                        ● LIVE
                    </span>

                </div>

                <div class="space-y-4">

                    @forelse($activities as $activity)

                        <div class="flex items-start gap-4 p-5 rounded-2xl bg-zinc-950 border border-zinc-800">

                            <div class="text-2xl">

                                @if($activity['type'] === 'sms')
                                    📨
                                @elseif($activity['type'] === 'call')
                                    📞
                                @elseif($activity['type'] === 'deposit')
                                    💰
                                @elseif($activity['type'] === 'callerid')
                                    🪪
                                @elseif($activity['type'] === 'senderid')
                                    🏷️
                                @else
                                    ⚡
                                @endif

                            </div>

                            <div class="flex-1">

                                <p class="font-semibold text-lg">

                                    {{ $activity['message'] }}

                                </p>

                                <p class="text-zinc-500 text-sm mt-1">

                                    {{ $activity['time']->diffForHumans() }}

                                </p>

                            </div>

                        </div>

                    @empty

                        <div class="text-zinc-500">

                            No recent activity found.

                        </div>

                    @endforelse

                </div>

            </div>

        </div>

    </div>

    <!-- ApexCharts -->

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>

        /*
        |--------------------------------------------------------------------------
        | SMS Chart
        |--------------------------------------------------------------------------
        */

        new ApexCharts(document.querySelector("#smsChart"), {

            chart: {
                type: 'area',
                height: 250,
                toolbar: {
                    show: false
                }
            },

            series: [{
                name: 'SMS',
                data: @json($smsWeekly)
            }],

            xaxis: {
                categories: ['6d','5d','4d','3d','2d','1d','Today']
            },

            theme: {
                mode: 'dark'
            }

        }).render();

        /*
        |--------------------------------------------------------------------------
        | Calls Chart
        |--------------------------------------------------------------------------
        */

        new ApexCharts(document.querySelector("#callChart"), {

            chart: {
                type: 'line',
                height: 250,
                toolbar: {
                    show: false
                }
            },

            series: [{
                name: 'Calls',
                data: @json($callWeekly)
            }],

            xaxis: {
                categories: ['6d','5d','4d','3d','2d','1d','Today']
            },

            theme: {
                mode: 'dark'
            }

        }).render();

        /*
        |--------------------------------------------------------------------------
        | Deposit Chart
        |--------------------------------------------------------------------------
        */

        new ApexCharts(document.querySelector("#depositChart"), {

            chart: {
                type: 'bar',
                height: 250,
                toolbar: {
                    show: false
                }
            },

            series: [{
                name: 'Deposits',
                data: @json($depositWeekly)
            }],

            xaxis: {
                categories: ['6d','5d','4d','3d','2d','1d','Today']
            },

            theme: {
                mode: 'dark'
            }

        }).render();

    </script>

</x-app-layout>