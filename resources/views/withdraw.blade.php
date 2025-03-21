<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Withdraw') }}
        </h2>
    </x-slot>
    @if(request()->method() == 'POST')
     <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <b>{{request()->post('amount')}}</b> INR Withdrawed Successfully !
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
                                {{ __('Withdraw Money') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __("Withdraw some cash from your account.") }}
                            </p>
                        </header>
                        


                        <form method="post" action="{{ route('withdraw.save') }}" class="mt-6 space-y-6">
                            @csrf
                            @method('post')

                            <div>
                                <x-input-label for="name" :value="__('Amount')" />
                                <x-amount-input id="name" name="amount" type="number" class="mt-1 block w-full"
                                    :value="old('amount', $user->name)" required autofocus autocomplete="name" />
                                <x-input-error class="mt-2" :messages="$errors->get('amount')" />
                            </div>


                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Withdraw') }}</x-primary-button>
                            </div>
                        </form>
                    </section>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
