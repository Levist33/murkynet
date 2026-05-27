<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white leading-tight">
            Bulk SMS
        </h2>
    </x-slot>

    <div class="min-h-screen bg-black text-white py-10">

        <div class="max-w-5xl mx-auto px-6">

            <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-8">

                <h3 class="text-4xl font-bold mb-10">
                    Bulk SMS Campaign
                </h3>

                @if(session('success'))

                    <div class="bg-green-500/20 border border-green-500 text-green-400 p-4 rounded-xl mb-6">
                        {{ session('success') }}
                    </div>

                @endif

                @if(session('error'))

                    <div class="bg-red-500/20 border border-red-500 text-red-400 p-4 rounded-xl mb-6">
                        {{ session('error') }}
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

                <form
                    method="POST"
                    action="/send-sms"
                    enctype="multipart/form-data"
                    class="space-y-8">

                    @csrf

                    <!-- Sender ID -->

                    <div>

                        <label class="block mb-3 text-zinc-400">
                            Sender ID
                        </label>

                        <select
                            name="sender_id_id"
                            class="w-full bg-black border border-zinc-700 rounded-xl p-5 text-white">

                            <option value="">
                                Select Sender ID
                            </option>

                            @foreach($senderids as $senderid)

                                <option value="{{ $senderid->id }}">
                                    {{ $senderid->sender_id }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                    <!-- Upload Numbers File -->

                    <div>

                        <label class="block mb-3 text-zinc-400">
                            Upload Numbers File (.txt or .csv)
                        </label>

                        <input
                            type="file"
                            name="numbers_file"
                            class="w-full bg-black border border-zinc-700 rounded-xl p-5 text-white">

                        <p class="text-sm text-zinc-500 mt-2">
                            One phone number per line
                        </p>

                    </div>

                    <!-- Message -->

                    <div>

                        <label class="block mb-3 text-zinc-400">
                            Message
                        </label>

                        <textarea
                            name="message"
                            rows="8"
                            placeholder="Enter SMS message"
                            class="w-full bg-black border border-zinc-700 rounded-xl p-5 text-white"></textarea>

                    </div>

                    <!-- Pricing -->

                    <div class="bg-black border border-zinc-800 rounded-xl p-5">

                        <div class="flex justify-between items-center">

                            <span class="text-zinc-400">
                                SMS Rate
                            </span>

                            <span class="text-orange-400 text-xl font-bold">
                                $0.05 / SMS
                            </span>

                        </div>

                    </div>

                    <!-- Submit -->

                    <button
                        type="submit"
                        class="bg-orange-500 hover:bg-orange-600 transition px-8 py-5 rounded-xl font-bold text-lg">

                        Launch Campaign

                    </button>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>