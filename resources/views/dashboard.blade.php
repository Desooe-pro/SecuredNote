<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="flex mt-4 flex-wrap gap-8 justify-evenly justify-self-center">
        @if( !empty($retour) )
            @foreach( $retour as $note )
                <a href="/notes/{{ $note->id }}">
                    <div class="flex w-96 h-fit bg-zinc-700 p-6 flex-col justify-between rounded-3xl text-zinc-300 shadow-zinc-800 shadow-xl">
                        <h3 class="text-2xl">{{ $note->title }}</h3>
                        <div class="bg-zinc-500 flex flex-wrap justify-start w-full p-6">
                            @foreach( $note->content as $content )
                                <p class="text-gray-300 block w-full">{{ $content }}</p>
                            @endforeach
                        </div>
                    </div>
                </a>
            @endforeach
        @else
            <h2 class="text-2xl text-gray-300">{{ $message }}</h2>
        @endif
    </div>
    <div class="flex mt-4 flex-wrap gap-8 justify-evenly justify-self-center">
        <a href="/ajouter/notes">
            <button class="dark:bg-gray-800 dark:text-gray-200 dark:shadow-gray-50 dark:shadow-sm p-3 rounded-3xl">
                Créer une note
            </button>
        </a>
        @if( !empty($retour) )
            <a  href="/notes">
                <button class="dark:bg-gray-800 dark:text-gray-200 dark:shadow-gray-50 dark:shadow-sm p-3 rounded-3xl">
                    Voir tout
                </button>
            </a>
        @endif
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
