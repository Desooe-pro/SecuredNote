<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Nouvelle note') }}
        </h2>
    </x-slot>

    <div class="flex pl-64 mt-4 flex-wrap justify-evenly justify-self-start w-[150px] h-[50px]">
        <a href="{{ route($back) }}">
            <button class="text-2xl w-[150px] h-[50px] dark:bg-gray-800 dark:text-gray-200 dark:shadow-gray-50 dark:shadow-sm rounded-3xl">
                Retour
            </button>
        </a>
    </div>

    <div class="flex w-full justify-center">
        <form method="POST" action="{{ route("notes.ajouter") }}" class="w-full">
            @csrf
            <div class="flex w-full justify-center flex-wrap mb-8">
                <div class="flex w-8/12 justify-center flex-wrap">
                    <label class="text-2xl  dark:text-gray-200">Titre</label>
                    <input type="text" class="dark:text-gray-200 w-full rounded-2xl dark:bg-gray-700 border-2 border-t-gray-100 border-l-gray-100 border-b-zinc-400 border-r-zinc-400 px-6"
                           name="title" placeholder="Liste de course" required
                    >
                </div>
            </div>
            <div class="flex w-full justify-center flex-wrap mb-8">
                <div class="flex w-8/12 justify-center flex-wrap">
                    <label class="text-2xl dark:text-gray-200" >Contenu</label>
                    <input type="text" class="dark:text-gray-200 w-full rounded-2xl dark:bg-gray-700 border-2 border-t-gray-100 border-l-gray-100 border-b-zinc-400 border-r-zinc-400 px-6"
                           name="content" placeholder="A prendre : - Farine - Lait - Glace" required
                    >
                </div>
            </div>
            <div class="flex w-full justify-center flex-wrap mb-8" style="display: none">
                <div class="flex w-8/12 justify-center flex-wrap">
                    <label class="text-2xl dark:text-gray-200" >Back</label>
                    <input type="text" class="w-full rounded-2xl dark:bg-gray-700 border-2 border-t-gray-100 border-l-gray-100 border-b-zinc-400 border-r-zinc-400 px-6" name="back" value="{{ $back }}" required>
                </div>
            </div>
            <div class="flex w-full justify-center flex-wrap">
                <div class="w-[150px] h-[50px]">
                    <button type="submit" class="flex w-[150px] h-[50px] justify-center flex-col text-center text-2xl dark:bg-gray-800 dark:text-gray-200 dark:shadow-gray-50 dark:shadow-sm p-3 rounded-3xl">
                        Ajouter
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
