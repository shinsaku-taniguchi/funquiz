<x-app-layout>
    <x-slot name="header">
        <h2 class="text-center font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            問題詳細画面
        </h2>
    </x-slot>

    <form action="{{ route('questions.update', $question) }}" method="post">
        @csrf
        @method('PUT')
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="flex flex-row">
                        <div class=" w-1/2 p-6 text-gray-900 dark:text-gray-100">
                            <p class="">問題文</p>
                            <p class="whitespace-pre-line overflow-y-scroll mb-10 p-2 h-32 w-4/5 border-2 border-gray-400">{{ $question->description}}</p>
                            <ul>
                                <li class="mb-5 w-4/5">
                                    <p>選択肢1</p>
                                    <p class="px-2 border rounded border-gray-400">{{ $question->choice1 }}</p>
                                </li>
                                <li class="mb-5 w-4/5">
                                    <p>選択肢2</p>
                                    <p class="px-2 border rounded border-gray-400" id="choice2" name="choice2">{{ $question->choice2 }}</p>
                                </li>
                                <li class="mb-5 w-4/5">
                                    <p>選択肢3</p>
                                    <p class="px-2 border rounded border-gray-400" id="choice3" name="choice3">{{ $question->choice3 }}</p>
                                </li>
                                <li class="mb-5 w-4/5">
                                    <p>選択肢4</p>
                                    <p class="px-2 border rounded border-gray-400" id="choice4" name="choice4">{{ $question->choice4 }}</p>
                                </li>
                            </ul>
                            <p>答え</p>
                            <p class="w-fit px-4 py-2 border rounded border-gray-400">{{ $question->answer }}</p>
                        </div>

                        <div class="w-1/2 p-6">
                            <p class="">解説</p>
                            <p class="whitespace-pre-line overflow-y-scroll mb-10 p-2 h-32 w-4/5 border-2 border-gray-300">{{ $question->answer_description }}</p>

                            <p>詳細</p>

                            <ul class="flex flex-col mt-4">
                                <li class="mb-6">
                                    <div>
                                        <p class="">国名 </p>
                                        @foreach($countries as $country)
                                        @if ($country->id === $question->country_id)
                                        <p class="px-2 border rounded border-gray-400"> {{ $country->name }}</p>
                                        @else
                                        <p> {{ '' }}</p>
                                        @endif
                                        @endforeach
                                    </div>
                                </li>

                                <li class="mb-6">
                                    <div>
                                        <p>アーティスト名 </p>
                                        @foreach($artists as $artist)
                                        @if ($artist->id === $question->artist_id)
                                        <p class="px-2 border rounded border-gray-400"> {{ $artist->name }}</p>
                                        @else
                                        <p> {{ '' }}</p>
                                        @endif
                                        @endforeach
                                    </div>
                                </li>

                                <li class="mb-6">
                                    <div>
                                        <p>ジャンル </p>
                                        @foreach($genres as $genre)
                                        @if ($genre->id === $question->genre_id)
                                        <p class="px-2 border rounded border-gray-400"> {{ $genre->name }}</p>
                                        @else
                                        <p> {{ '' }}</p>
                                        @endif
                                        @endforeach
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="w-fit mx-auto my-4">
                        @php
                        $page = ceil($question["id"] / 10);
                        @endphp
                        <a href="{{ route('questions.index', ['page' => $page]) }}">
                            <x-primary-button type="button">戻る</x-primary-button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-app-layout>