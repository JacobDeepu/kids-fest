<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Participants') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg px-4 py-4">
                    <x-jet-validation-errors class="mb-4" />
                    <form method="POST" action="{{ route('participant.update', $participant) }}">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 lg:grid-cols-4 gap-4">
                            <div>
                                <x-jet-label for="name" value="{{ __('Name') }}" />
                                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $participant->name)" required autofocus autocomplete="name" />
                            </div>
                            <div>
                                <x-jet-label for="event" value="{{ __('Event') }}" />
                                <x-jet-input id="event" class="block mt-1 w-full" type="text" name="event" :value="old('event', $participant->event->name)" disabled />
                            </div>
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