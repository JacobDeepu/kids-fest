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
                    <div id="accordion-collapse" data-accordion="collapse">
                        @foreach($events as $event)
                        <h3 id="accordion-collapse-heading-{{ $event->id }}" class="font-semibold text-xl text-gray-800 leading-tight">
                            <button type="button" class="flex items-center justify-between w-full p-5 font-medium text-left border {{ $loop->last ? '' : 'border-b-0' }} border-gray-200 {{ $loop->first ? 'rounded-t-xl' : '' }} focus:ring-4 focus:ring-gray-200 hover:bg-gray-100 bg-gray-100 text-gray-900" data-accordion-target="#accordion-collapse-body-{{ $event->id }}" {{ $loop->first ? 'aria-expanded=true' : 'aria-expanded=false' }} aria-controls="accordion-collapse-body-{{ $event->id }}">
                                <span>{{ $event->name }}</span>
                                <svg data-accordion-icon="" class="w-6 h-6 rotate-180 shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </h3>
                        <div id="accordion-collapse-body-{{ $event->id }}" class="" aria-labelledby="accordion-collapse-heading-{{ $event->id }}">
                            <div class="p-5 font-light border {{ $loop->last ? 'border-t-0' : 'border-b-0' }} border-gray-200">
                                @if($participants->where('event_id', $event->id)->count() != $event->max_participants)
                                <form method="POST" action="{{ route('participant.store') }}">
                                    @csrf
                                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                                        <input name="event_id" value="{{ $event->id }}" hidden>
                                            <div>
                                                <x-jet-label for="name" value="{{ __('Name') }}" />
                                                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" autocomplete="name" />
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
                                @endif
                                @if($participants->where('event_id', $event->id)->count() != 0)
                                <form method="POST" action="{{ route('participant.update', $event) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                                        @foreach($participants->where('event_id', $event->id) as $participant)
                                            <div>
                                                <input id="participant_id[]" name="participant_id[]" value="{{ $participant->id }}" hidden />
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
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="flex justify-between mt-4">
                        <div class="py-4">
                            <x-jet-button>
                                {{ __('Save') }}
                            </x-jet-button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/flowbite@1.5.3/dist/flowbite.js"></script>
</x-app-layout>