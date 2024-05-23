<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Show Drive : {{ $drive->id }}
        </h2>
    </x-slot>
    <div class="container">

        <div class="card mt-5 bg-dark text-white">

            <div class="card-body text-center">
                <div class="file">
                    <h1>{{$drive->title}}</h1>
                    <h3>{{$drive->description}}</h3>
                    <embed src="{{ asset("uploads/$drive->drive") }}" width="100%" height="400">
                </div>
            </div>

        </div>
    </div>

    </div>

</x-app-layout>
