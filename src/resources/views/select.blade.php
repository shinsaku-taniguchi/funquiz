<x-app-layout>
    <x-slot name="header">
        <h2 class="text-center font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            問題のカテゴリーを選択してください！
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex justify-around p-2 sm:p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex flex-col">
                        <p>カントリー</p>
                        @foreach($countries as $country)
                        <a class="flex justify-center" href="{{ route('start.index', ['country_id' => $country->id]) }}">
                            <x-primary-button type="button" class="mb-4">{{ $country->name }}</x-primary-button>
                        </a>
                        @endforeach
                    </div>
                    <div class="flex flex-col">
                        <p>アーティスト</p>
                        @foreach($artists as $artist)
                        <a class="flex justify-center" href="{{ route('start.index', ['artist_id' => $artist->id]) }}">
                            <x-primary-button type="button" class="mb-4 ">{{ $artist->name }}</x-primary-button>
                        </a>
                        @endforeach
                    </div>
                    <div class="flex flex-col">
                        <p>ジャンル</p>
                        @foreach($genres as $genre)
                        <a class="flex justify-center" href="{{ route('start.index', ['genre_id' => $genre->id]) }}">
                            <x-primary-button type="button" class="mb-4">{{ $genre->name }}</x-primary-button>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>