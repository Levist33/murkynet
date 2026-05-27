<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white leading-tight">
            Bulk SMS Campaign
        </h2>
    </x-slot>

    <div class="min-h-screen bg-black text-white py-10">

        <div class="max-w-4xl mx-auto px-6">

            <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-8">

                <h3 class="text-3xl font-bold mb-8">
                    Send Bulk SMS
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

                <form
                    method="POST"
                    action="/bulk-sms"
                    enctype="multipart/form-data"
                    class="space-y-6">

                    @csrf

                    <!-- Sender ID -->

                    <div>

                        <label class="block mb-2 text-zinc-400">
                            Sender ID
                        </label>

                        <select
                            name="sender_id"
                            class="w-full bg-black border border-zinc-700 rounded-xl p-4">

                            @foreach($senderids as $senderid)

                                <option value="{{ $senderid->id }}">

                                    {{ $senderid->sender_id }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <!-- CSV Upload -->

                    <div>

                        <label class="block mb-2 text-zinc-400">
                            Upload Numbers File (.txt or .csv)
                        </label>

                        <input
                            type="file"
                            name="numbers_file"
                            class="w-full bg-black border border-zinc-700 rounded-xl p-4">

                    </div>

                    <!-- Message -->

                    <div>

                        <label class="block mb-2 text-zinc-400">
                            Message
                        </label>

                        <textarea
                            name="message"
                            rows="6"
                            placeholder="Enter SMS message"
                            class="w-full bg-black border border-zinc-700 rounded-xl p-4"></textarea>

                    </div>

                    <!-- Pricing -->

                    <div class="bg-black border border-zinc-800 rounded-xl p-4">

                        <div class="flex justify-between">

                            <span class="text-zinc-400">
                                SMS Rate
                            </span>

                            <span class="text-orange-400 font-bold">
                                $0.05 / SMS
                            </span>

                        </div>

                    </div>

                    <!-- Submit -->

                    <button
                        type="submit"
                        class="bg-orange-500 hover:bg-orange-600 px-6 py-4 rounded-xl font-semibold">

                        Launch Campaign

                    </button>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>