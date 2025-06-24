<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-4xl text-gray-800 dark:text-gray-200 leading-tight">
            @if( !empty($nom) )
                {{ __("Tentative de suppression d'une note non autorisée par l'utilisateur : " . $nom) }}
            @else
                {{ redirect()->route("notes") }}
            @endif
        </h2>
    </x-slot>

    <div class="flex pl-64 mt-4 flex-wrap justify-evenly justify-self-start w-[150px] h-[50px]">
        <a href="{{ route("dashboard") }}">
            <button class="text-2xl w-[150px] h-[50px] dark:bg-gray-800 dark:text-gray-200 dark:shadow-gray-50 dark:shadow-sm rounded-3xl">
                Retour
            </button>
        </a>
    </div>

    <div class="flex mt-4 flex-wrap gap-8 justify-evenly justify-self-center">
        @if( !empty($message) )
            <h2 class="text-2xl text-gray-300">{{ $message }}</h2>
        @endif
    </div>
</x-app-layout>
