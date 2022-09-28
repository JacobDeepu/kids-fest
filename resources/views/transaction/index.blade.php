<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Participants') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <div class="bg-white relative overflow-x-auto shadow-md sm:rounded-lg">
                    <div class="flex justify-between items-center">
                        <form class="m-4" method="GET" action="{{ route('transaction.index') }}">
                            <div class="flex">
                                <div class="relative w-full">
                                    <select class="w-56 rounded-lg py-2 w-full z-20 text-sm text-gray-900 bg-gray-50 border border-gray-300 focus:ring-blue-500 focus:border-blue-500" id="school_filter" name="school_filter">
                                        <option value="" selected>All Schools</option>
                                        @foreach( $schools as $school )
                                        <option value="{{ $school->user->id }}" @if (request()->input('school_filter')==$school->user->id) selected @endif>{{ $school->user->name }}</option>
                                        @endforeach
                                    </select>
                                    <x-jet-button class="inline-flex">
                                        {{ __('Filter') }}
                                    </x-jet-button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    {{ __('School Name') }}
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    {{ __('Reference Number') }}
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    {{ __('Bank Name') }}
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    {{ __('Amount') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($transactions as $transaction)
                            <tr class="bg-white border-b">
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $transaction->user->name }}
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $transaction->reference_no }}
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $transaction->bank }}
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $transaction->amount }}
                                </td>
                            </tr>
                            @empty
                            <tr class="bg-white border-b">
                                <td colspan="2" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ __('No Events Found') }}
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="px-6 py-4">
                        {{ $transactions->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>