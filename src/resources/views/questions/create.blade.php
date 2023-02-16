<x-app-layout>
    <x-slot name="header">
        <h2 class="text-center font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            管理者専用 問題投稿画面
        </h2>
    </x-slot>

    <form action="{{ route('questions.store') }}" method="post">
        @csrf
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="flex flex-row">
                        <div class=" w-1/2 p-6 text-gray-900 dark:text-gray-100">

                            <p class="">問題文</p>
                            <textarea name="description" class="whitespace-pre-line overflow-y-scroll mb-10 h-32 w-4/5 border-2 border-gray-400" required></textarea>
                            <ul>
                                <li class="mb-5">
                                    <div class="flex justify-between">
                                        <p>回答1</p>
                                    </div>
                                    <x-text-input id="choice1" name="choice1" class="mr-4 w-4/5 border-2 border-black" required />
                                </li>
                                <li class="mb-5">
                                    <p>回答2</p>
                                    <x-text-input id="choice2" name="choice2" class="mr-4 w-4/5 border-2 border-black" required />
                                </li>
                                <li class="mb-5">
                                    <p>回答3</p>
                                    <x-text-input id="choice3" name="choice3" class="mr-4 w-4/5 border-2 border-black" required />
                                </li>
                                <li class="mb-5">
                                    <p>回答4</p>
                                    <x-text-input id="choice4" name="choice4" class="mr-4 w-4/5 border-2 border-black" required />
                                </li>
                            </ul>
                            <select name="answer" id="" required>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>

                        </div>

                        <div class="w-1/2 p-6">
                            <p class="">解説</p>
                            <textarea id="question" name="answer_description" class="mb-10 h-32 w-4/5 border-2 border-gray-400"></textarea>

                            <p>詳細設定</p>

                            <ul class="flex flex-col mt-4">
                                <li class="mb-6">
                                    <div>
                                        <p class="">国名 </p>
                                        <select name="country_id" id="">
                                            <option value=""></option>
                                            @foreach($countries as $country)
                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </li>

                                <li class="mb-6">
                                    <div>
                                        <p class="">アーティスト名 </p>
                                        <select name="artist_id" id="">
                                            <option value=""></option>
                                            @foreach($artists as $artist)
                                            <option value="{{ $artist->id }}">{{ $artist->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </li>

                                <li class="mb-6">
                                    <div>
                                        <p class="">ジャンル </p>
                                        <select name="genre_id" id="">
                                            <option value=""></option>
                                            @foreach($genres as $genre)
                                            <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="w-fit mx-auto my-4">
                        <x-primary-button type="submit">問題を登録</x-primary-button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-app-layout>