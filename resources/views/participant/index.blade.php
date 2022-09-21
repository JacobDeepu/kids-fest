<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Participant Registration') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <div class="relative overflow-x-auto sm:rounded-lg">
                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 p-4">
                        @forelse ($events as $event)
                        <div class="p-6 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{ $event->name }}</h5>
                            <p class="mb-3 font-normal text-gray-700">{{ $event->section->name }}</p>
                            <a href="{{ route('participant.create', ['event' => $event->id]) }}" class="inline-flex items-center py-2 px-3 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                Register
                                <svg aria-hidden="true" class="ml-2 -mr-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                </svg>
                            </a>
                        </div>
                        @empty
                        <div class="bg-white border-b">
                            <div class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ __('No Events Found') }}
                            </div>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>