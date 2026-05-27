<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white leading-tight">
            Deposit Funds
        </h2>
    </x-slot>

    <div class="min-h-screen bg-black text-white py-10">

        <div class="max-w-3xl mx-auto px-6">

            <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-8">

                <h3 class="text-3xl font-bold mb-8">
                    Crypto Deposit
                </h3>

                @if(session('success'))

                    <div class="bg-green-500/20 text-green-400 p-4 rounded-xl mb-6">
                        {{ session('success') }}
                    </div>

                @endif

                <form method="POST" action="/deposit" class="space-y-6">

                    @csrf

                    <!-- Currency -->

                    <div>

                        <label class="block mb-2 text-zinc-400">
                            Currency
                        </label>

                        <select
                            id="currencySelect"
                            name="currency"
                            class="w-full bg-black border border-zinc-700 rounded-xl p-4">

                            <option value="USDT">USDT</option>

                            <option value="BTC">BTC</option>

                            <option value="ETH">ETH</option>

                            <option value="BNB">BNB</option>

                            <option value="SOL">SOL</option>

                            <option value="LTC">LTC</option>

                        </select>

                    </div>

                    <!-- Network -->

                    <div>

                        <label class="block mb-2 text-zinc-400">
                            Network
                        </label>

                        <select
                            id="networkSelect"
                            name="network"
                            class="w-full bg-black border border-zinc-700 rounded-xl p-4">

                            <option value="TRC20">TRC20</option>

                            <option value="ERC20">ERC20</option>

                            <option value="BEP20">BEP20</option>

                            <option value="BTC">BTC</option>

                            <option value="SOL">SOL</option>

                        </select>

                    </div>

                    <!-- Amount -->

                    <div>

                        <label class="block mb-2 text-zinc-400">
                            Amount
                        </label>

                        <input
                            type="number"
                            step="0.01"
                            name="amount"
                            placeholder="Enter amount"
                            class="w-full bg-black border border-zinc-700 rounded-xl p-4">

                    </div>

                    <!-- Hidden Wallet Select -->

                    <select
                        id="walletSelect"
                        name="wallet_address"
                        class="hidden">

                        @foreach($wallets as $wallet)

                            <option
                                value="{{ $wallet->wallet_address }}"
                                data-currency="{{ $wallet->currency }}"
                                data-network="{{ $wallet->network }}">

                                {{ $wallet->wallet_address }}

                            </option>

                        @endforeach

                    </select>

                    <!-- Wallet Display -->

                    <div>

                        <label class="block mb-2 text-zinc-400">
                            Deposit Address
                        </label>

                        <div class="flex gap-3">

                            <input
                                type="text"
                                id="walletDisplay"
                                readonly
                                class="w-full bg-black border border-zinc-700 rounded-xl p-4 text-orange-400">

                            <button
                                type="button"
                                onclick="copyWallet()"
                                class="bg-orange-500 hover:bg-orange-600 px-5 rounded-xl font-semibold">

                                Copy

                            </button>

                        </div>

                    </div>

                    <!-- TXID -->

                    <div>

                        <label class="block mb-2 text-zinc-400">
                            Transaction ID (TXID)
                        </label>

                        <input
                            type="text"
                            name="txid"
                            placeholder="Paste TXID"
                            class="w-full bg-black border border-zinc-700 rounded-xl p-4">

                    </div>

                    <!-- Submit -->

                    <button
                        type="submit"
                        class="bg-orange-500 hover:bg-orange-600 px-6 py-4 rounded-xl font-semibold">

                        Submit Deposit

                    </button>

                </form>

            </div>

        </div>

    </div>

    <script>

        function filterWallets() {

            const currency =
                document.getElementById('currencySelect').value;

            const network =
                document.getElementById('networkSelect').value;

            const walletSelect =
                document.getElementById('walletSelect');

            const walletDisplay =
                document.getElementById('walletDisplay');

            const options = walletSelect.options;

            for (let i = 0; i < options.length; i++) {

                const option = options[i];

                const optionCurrency =
                    option.getAttribute('data-currency');

                const optionNetwork =
                    option.getAttribute('data-network');

                if (
                    optionCurrency === currency &&
                    optionNetwork === network
                ) {

                    walletSelect.value = option.value;

                    walletDisplay.value = option.value;

                    return;
                }
            }

            walletDisplay.value = 'No wallet available';
        }

        function copyWallet() {

            const wallet =
                document.getElementById('walletDisplay');

            wallet.select();

            wallet.setSelectionRange(0, 99999);

            navigator.clipboard.writeText(wallet.value);

            alert('Wallet address copied!');
        }

        document
            .getElementById('currencySelect')
            .addEventListener('change', filterWallets);

        document
            .getElementById('networkSelect')
            .addEventListener('change', filterWallets);

        filterWallets();

    </script>

</x-app-layout>