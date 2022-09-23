<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Event') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg px-4 py-4">
                    <x-jet-validation-errors class="mb-4" />
                    <form method="POST" action="{{ route('participant.update', $event) }}">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                            <input id="user_id" name="user_id" value="{{ auth()->user()->id }}" hidden />
                            <input id="event_id" name="event_id" value="{{ $event->id }}" hidden />
                            <input id="max_participants" name="max_participants" value="{{ $event->max_participants }}" hidden />
                            @foreach($participants as $participant)
                                <div>
                                    <x-jet-label for="name" value="{{ __('Name') }}" />
                                    <x-jet-input id="name[]" class="block mt-1 w-full" type="text" name="name[]" :value="old('name.'.$loop->index, $participant->name)" required autofocus autocomplete="name" />
                                </div>
                                <div>
                                    <x-jet-label for="section" value="{{ __('Class') }}" />
                                    <select class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full" name="section_id[]">
                                        <option value="{{ $participant->event->section->id }}" selected>{{ $participant->event->section->name }}</option>
                                    </select>
                                </div>
                            @endforeach
                        </div>
                        <div class="flex mt-4">
                            <x-jet-button>
                                {{ __('Save') }}
                            </x-jet-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>