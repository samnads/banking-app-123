<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Transfer') }}
        </h2>
    </x-slot>
    @if (request()->method() == 'POST')
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <b>{{ request()->post('amount') }}</b> INR Transferred Successfully !
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <section>
                    <div class="overflow-x-auto">
                        <table class="w-full border border-gray-300 bg-white shadow-md rounded-lg">
                            <thead class="bg-gray-200 border-b border-gray-300">
                                <tr>
                                    <th class="px-6 py-3 text-left border-r border-gray-300">Date</th>
                                    <th class="px-6 py-3 text-left border-r border-gray-300">Type</th>
                                    <th class="px-6 py-3 text-left border-r border-gray-300">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transactions as $transaction)
                                <tr class="border-b border-gray-300 hover:bg-gray-100">
                                    <td class="px-6 py-4 border-r border-gray-300">{{ date('Y-m-d', strtotime($transaction->created_at)) }}</td>
                                    <td class="px-6 py-4 border-r border-gray-300">{{ $transaction->type }}</td>
                                    <td class="px-6 py-4 border-r border-gray-300">{{ $transaction->amount < 0 ? '-' : '+' }} {{ abs($transaction->amount) }} INR</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </section>
            </div>
        </div>
    </div>
</x-app-layout>
