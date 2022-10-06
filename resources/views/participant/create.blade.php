<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Participant Registration') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg px-4 py-4">
                    <x-jet-validation-errors class="mb-4" />
                    @if(!auth()->user()->transaction)
                    <div id="accordion" data-accordion="collapse">
                        @foreach($events as $event)
                        <h3 id="accordion-heading-{{ $event->id }}" class="font-semibold text-xl text-gray-800 leading-tight">
                            <button type="button" class="flex items-center justify-between w-full p-5 font-medium text-left border {{ $loop->last ? '' : 'border-b-0' }} border-gray-200 {{ $loop->first ? 'rounded-t-xl' : '' }} focus:ring-4 focus:ring-gray-200 hover:bg-gray-100 bg-gray-100 text-gray-900" data-accordion-target="#accordion-body-{{ $event->id }}" aria-expanded=@if(session('event')==$event->id) true @else false @endif aria-controls="accordion-body-{{ $event->id }}">
                                <span>{{ $event->name }}</span>
                                <svg data-accordion-icon="" class="w-6 h-6 rotate-180 shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </h3>
                        <div id="accordion-body-{{ $event->id }}" class="" aria-labelledby="accordion-heading-{{ $event->id }}">
                            <div class="p-5 font-light border {{ $loop->last ? 'border-t-0' : 'border-b-0' }} border-gray-200">
                                @if($participants->where('event_id', $event->id)->count() != $event->max_participants)
                                <div class="flex justify-between">
                                    <h3 class="font-semibold text-xl text-gray-800 py-4">Add new participant</h3>
                                    <h3 class="font-semibold text-xl text-gray-800 py-4">Added: {{ $participants->where('event_id', $event->id)->count() }}</h3>
                                    <h3 class="font-semibold text-xl text-gray-800 py-4">Maximum: {{ $event->max_participants }}</h3>
                                </div>
                                <form method="POST" action="{{ route('participant.store') }}">
                                    @csrf
                                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                                        <input name="event_id" value="{{ $event->id }}" hidden>
                                        <div>
                                            <x-jet-label for="name" value="{{ __('Name') }}" />
                                            <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                                        </div>
                                        <div>
                                            <x-jet-label for="section" value="{{ __('Class') }}" />
                                            <select class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full" name="section_id">
                                                <option value="{{ $event->section->id }}" selected>{{ $event->section->name }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="flex mt-4">
                                        <x-jet-button>
                                            {{ __('Save') }}
                                        </x-jet-button>
                                    </div>
                                </form>
                                @else
                                <div class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ __('Please use Participants tab for editing / modification') }}
                                </div>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <h3 class="inline-flex font-semibold text-xl text-gray-800 leading-tight py-4">Transaction Details</h3>
                    <p class="ml-4 text-lg text-gray-800 font-semibold">Account details</p>
                    <div class="ml-4 text-base text-gray-600">
                        <p>Name : Dummy</p>
                    </div>
                    <form method="POST" action="{{ route('transaction.store') }}">
                        @csrf
                        <p class="m-4 text-base font-semibold text-blue-900">Total Amount = {{ $amount }}</p>
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                            <input id="user_id" name="user_id" value="{{ auth()->user()->id }}" hidden />
                            <input id="amount" name="amount" value="{{ $amount }}" hidden />
                            <div>
                                <x-jet-label for="name" value="{{ __('Account Holder Name') }}" />
                                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autocomplete="name" />
                            </div>
                            <div>
                                <x-jet-label for="school" value="{{ __('School') }}" />
                                <x-jet-input id="school" class="block mt-1 w-full" type="text" name="school" :value="auth()->user()->name" />
                            </div>
                            <div>
                                <x-jet-label for="reference_no" value="{{ __('Reference Number') }}" />
                                <x-jet-input id="reference_no" class="block mt-1 w-full" type="text" name="reference_no" :value="old('reference_no')" required autocomplete="reference_no" />
                            </div>
                            <div>
                                <x-jet-label for="bank" value="{{ __('Bank Name') }}" />
                                <x-jet-input id="bank" class="block mt-1 w-full" type="text" name="bank" :value="old('bank')" required autocomplete="bank" />
                            </div>
                        </div>
                        <div class="flex mt-4">
                            <x-jet-button>
                                {{ __('Final Submit') }}
                            </x-jet-button>
                        </div>
                    </form>
                    @else
                    <div class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        {{ __('Please use Participants tab for editing / modification') }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/flowbite@1.5.3/dist/flowbite.js"></script>
</x-app-layout>