<x-app-layout>
    <x-slot name="header">
        <h2 class="text-center font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            管理者専用 編集画面
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

                            <p>問題文</p>
                            <textarea name="description" class="whitespace-pre-wrap mb-10 h-32 w-4/5 border-2 border-black" required>{{ old('description', $question) }}</textarea>
                            <ul>
                                <li class="mb-5">
                                    <p>回答1</p>
                                    <x-text-input id="choice1" name="choice1" class="mr-4 w-4/5 border-2 border-black" required :value="old('choice1', $question)" />
                                </li>
                                <li class="mb-5">
                                    <p>回答2</p>
                                    <x-text-input id="choice2" name="choice2" class="mr-4 w-4/5 border-2 border-black" required :value="old('choice2', $question)" />
                                </li>
                                <li class="mb-5">
                                    <p>回答3</p>
                                    <x-text-input id="choice3" name="choice3" class="mr-4 w-4/5 border-2 border-black" required :value="old('choice3', $question)" />
                                </li>
                                <li class="mb-5">
                                    <p>回答4</p>
                                    <x-text-input id="choice4" name="choice4" class="mr-4 w-4/5 border-2 border-black" required :value="old('choice4', $question)" />
                                </li>
                            </ul>
                            <select name="answer" required>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>

                        </div>

                        <div class="w-1/2 p-6">
                            <p>解説</p>
                            <textarea name="answer_description" class="whitespace-pre-wrap mb-10 h-32 w-4/5 border-2 border-black"> {{ old('answer_description', $question) }}</textarea>

                            <p>詳細設定</p>

                            <ul class="flex flex-col mt-4">
                                <li class="mb-6">
                                    <div>
                                        <p class="">国名 </p>
                                        <select name="country_id">
                                            <option value=""></option>
                                            @foreach($countries as $country)
                                            <option value="{{ $country->id }}" {{ ($question->country_id === $country->id || (int) old('country_id') === $country->id) ? ' selected' : '' }}>{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </li>

                                <li class="mb-6">
                                    <div>
                                        <p class="">アーティスト名 </p>
                                        <select name="artist_id">
                                            <option value=""></option>
                                            @foreach($artists as $artist)
                                            <option value="{{ $artist->id }}" {{ ($question->artist_id === $artist->id || (int) old('artist_id') === $artist->id) ? ' selected' : '' }}>{{ $artist->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </li>

                                <li class="mb-6">
                                    <div>
                                        <p class="">ジャンル </p>
                                        <select name="genre_id">
                                            <option value=""></option>
                                            @foreach($genres as $genre)
                                            <option value="{{ $genre->id }}" {{ ($question->genre_id === $genre->id || (int) old('genre_id') === $genre->id) ? ' selected' : '' }}>{{ $genre->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="w-fit mx-auto my-4">
                        <x-primary-button type="submit">保存</x-primary-button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-app-layout>