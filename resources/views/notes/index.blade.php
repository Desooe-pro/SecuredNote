<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Vos Notes') }}
        </h2>
    </x-slot>

    <div class="flex mt-4 flex-wrap gap-8 justify-evenly justify-self-center">
        @if( !empty($message) )
            <h2 class="text-2xl text-gray-300">{{ $message }}</h2>
        @endif
    </div>
    <div class="flex mt-4 flex-wrap gap-8 justify-evenly justify-self-center">
        <a href="/ajouter/notes">
            <button class="dark:bg-gray-800 dark:text-gray-200 dark:shadow-gray-50 dark:shadow-sm p-3 rounded-3xl">
                Créer une note
            </button>
        </a>
    </div>
    <div class="flex mt-4 flex-wrap gap-8 justify-evenly justify-self-center">
        @if( !empty($retour) )
            @foreach( $retour as $note )
                <a href="/notes/{{ $note->id }}">
                    <div id="{{ $note->id }}" class="flex w-96 h-fit bg-zinc-700 p-6 flex-col justify-between rounded-3xl text-zinc-300 shadow-zinc-800 shadow-xl scroll-m-8">
                        <h3 class="text-2xl">{{ $note->title }}</h3>
                        <div class="bg-zinc-500 flex flex-col flex-wrap justify-start w-full p-6">
                            @foreach( $note->content as $content )
                                @if( !empty($content) )
                                    <p class="text-gray-300 block w-full">{{ $content }}</p>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </a>
            @endforeach
        @endif
    </div>
</x-app-layout>
