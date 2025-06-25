<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            @if( !empty($retour))
                {{ __("Note : " . $retour->title) }}
            @else
                {{ __("Note interdite") }}
            @endif
        </h2>
    </x-slot>

    <div class="flex pl-64 mt-4 flex-wrap justify-evenly justify-self-start w-[150px] h-[50px]">
        <a
            @if( !empty($retour) )
                href="{{ $back . "/#" . $retour->id }}"
            @else
                href="{{ $back }}"
            @endif
        >
            <button class="text-2xl w-[150px] h-[50px] dark:bg-gray-800 dark:text-gray-200 dark:shadow-gray-50 dark:shadow-sm rounded-3xl">
                Retour
            </button>
        </a>
    </div>

    <div class="flex mt-4 flex-wrap gap-8 justify-evenly justify-self-center">
        @if( !empty($retour) )
            <div class="flex min-w-96 w-fit h-fit bg-zinc-700 p-6 flex-col justify-between rounded-3xl text-zinc-300 shadow-zinc-800 shadow-xl">
                @foreach( $retour->content as $content )
                    @if( !empty($content) )
                        <h3 class="text-2xl">{{ $content }}</h3>
                    @endif
                @endforeach
            </div>
        @endif
        @if( !empty($message) )
            <h2 class="text-2xl text-gray-300">{{ $message }}</h2>
        @endif
    </div>

    @if( !empty($retour) )
        <div class="flex mt-4 flex-wrap gap-8 justify-evenly justify-self-center">
            <a href="/edit/{{ $retour->id }}">
                <button class="dark:bg-gray-800 dark:text-gray-200 dark:shadow-gray-50 dark:shadow-sm p-3 rounded-3xl">
                    Modifier la note
                </button>
            </a>
            <form action="{{ route("delete", $retour->id) }}">
                @csrf
                @method('DELETE')
                <button class="dark:bg-gray-800 dark:text-gray-200 dark:shadow-gray-50 dark:shadow-sm p-3 rounded-3xl">
                    Supprimer la note
                </button>
            </form>
        </div>
    @endif
</x-app-layout>
