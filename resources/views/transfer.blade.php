<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Transfer') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    Balance : {{ $balance }}
                </div>
            </div>
        </div>
    </div>
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
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Transfer Money') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('Transfer money to other account.') }}
                            </p>
                        </header>



                        <form method="post" action="{{ route('transfer.save') }}" class="mt-6 space-y-6">
                            @csrf
                            @method('post')


                            <div>
                                <x-input-label for="recipient_user_id" :value="__('Beneficiary Name')" />
                                <select name="recipient_user_id" id="recipient_user_id" required
                                    class="mt-1 block w-full p-2 border border-gray-300 bg-white rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    @foreach ($beneficiaries as $beneficiary)
                                        <option value="">-- Select Beneficiary --</option>
                                        <option value="{{ $beneficiary->id }}">{{ $beneficiary->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <x-input-label for="name" :value="__('Amount')" />
                                <x-amount-input id="name" name="amount" type="number" max="{{ $balance }}"
                                    class="mt-1 block w-full" :value="old('amount', $user->name)" required autofocus
                                    autocomplete="name" />
                                <x-input-error class="mt-2" :messages="$errors->get('amount')" />
                            </div>


                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Transfer') }}</x-primary-button>
                            </div>
                        </form>
                    </section>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
