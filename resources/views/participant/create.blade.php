<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Participants') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg px-4 py-4">
                    <x-jet-validation-errors class="mb-4" />
                    <form method="POST" action="{{ route('participant.store') }}">
                        @csrf
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                            <input id="user_id" name="user_id" value="{{ auth()->user()->id }}" hidden />
                            <input id="event_id" name="event_id" value="{{ $event->id }}" hidden />
                            <input id="max_participants" name="max_participants" value="{{ $event->max_participants }}" hidden />
                            @php
                                $amount = 0;
                            @endphp
                            @for ($i = 0; $i < $event->max_participants; $i++)
                                <div>
                                    <x-jet-label for="name" value="{{ __('Name') }}" />
                                    <x-jet-input id="name[]" class="block mt-1 w-full" type="text" name="name[]" :value="old('name.'.$i)" required autofocus autocomplete="name" />
                                </div>
                                <div>
                                    <x-jet-label for="section" value="{{ __('Class') }}" />
                                    <select class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full" name="section_id[]">
                                        <option value="{{ $section->id }}" selected>{{ $section->name }}</option>
                                    </select>
                                </div>
                                @php
                                    $amount += 50;
                                @endphp
                            @endfor
                        </div>
                        <div class="flex justify-between mt-4">
                            <div class="py-4">
                                <h3 class="inline-flex font-semibold text-xl text-gray-800 leading-tight py-2">Amount: {{ $amount }}</h3>
                            </div>
                            <div class="py-4">
                                <x-jet-button>
                                    {{ __('Save') }}
                                </x-jet-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>