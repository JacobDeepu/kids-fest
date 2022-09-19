<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Event') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg px-4 py-4">
                    <x-jet-validation-errors class="mb-4" />
                    <form method="POST" action="{{ route('event.store') }}">
                        @csrf
                        <div class="grid grid-cols-1 lg:grid-cols-4 gap-4">
                            <div>
                                <x-jet-label for="name" value="{{ __('Name') }}" />
                                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                            </div>
                            <div>
                                <x-jet-label for="section" value="{{ __('Class') }}" />
                                <select class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full" name="section_id">
                                    <option value="" selected>--Select Any--</option>
                                    @foreach( $sections as $section )
                                    <option value="{{ $section->id }}" @if (old('section_id')==$section->id) selected @endif>{{ $section->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <x-jet-label for="min_participants" value="{{ __('Minimun Participants') }}" />
                                <x-jet-input id="min_participants" class="block mt-1 w-full" type="number" name="min_participants" :value="old('min_participants')" required autofocus autocomplete="min_participants" />
                            </div>
                            <div>
                                <x-jet-label for="max_participants" value="{{ __('Maximum Participants') }}" />
                                <x-jet-input id="max_participants" class="block mt-1 w-full" type="number" name="max_participants" :value="old('max_participants')" required autofocus autocomplete="max_participants" />
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