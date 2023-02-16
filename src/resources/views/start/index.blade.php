<x-app-layout>
    <x-slot name="header">
        <h2 class="text-center font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Start Funquiz!
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex items-center flex-col p-6 text-gray-900 dark:text-gray-100">
                    <p id="question" class="text-center border-2 border-gray-500 mb-20 p-2 h-full w-full">{{ $question->description }}
                    </p>
                    <p class="w-1/3 mb-8 text-center border-b-2 border-gray-400">選択肢</p>
                    <ul class="flex flex-col">
                        <form action="{{ route('start.answer') }}" method="post">
                            @csrf
                            <input type="hidden" name="question_id" value="{{ $question->id }}">
                            <input type="hidden" name="user_answer" value="1">
                            <li class="mb-8">
                                <div class="w-fit mx-auto my-4">
                                    <x-secondary-button type="submit" class="border-2 border-gray-500">{{ $question->choice1 }}</x-secondary-button>
                                </div>
                            </li>
                        </form>
                        <form action="{{ route('start.answer') }}" method="post">
                            @csrf
                            <input type="hidden" name="question_id" value="{{ $question->id }}">
                            <input type="hidden" name="user_answer" value="2">
                            <li class="mb-8">
                                <div class="w-fit mx-auto my-4">
                                    <x-secondary-button type="submit" class="border-2 border-gray-500">{{ $question->choice2 }}</x-secondary-button>
                                </div>
                            </li>
                        </form>
                        <form action="{{ route('start.answer') }}" method="post">
                            @csrf
                            <input type="hidden" name="question_id" value="{{ $question->id }}">
                            <input type="hidden" name="user_answer" value="3">
                            <li class="mb-8">
                                <div class="w-fit mx-auto my-4">
                                    <x-secondary-button type="submit" class="border-2 border-gray-500">{{ $question->choice3 }}</x-secondary-button>
                                </div>
                            </li>
                        </form>
                        <form action="{{ route('start.answer') }}" method="post">
                            @csrf
                            <input type="hidden" name="question_id" value="{{ $question->id }}">
                            <input type="hidden" name="user_answer" value="4">
                            <li class="mb-8">
                                <div class="w-fit mx-auto my-4">
                                    <x-secondary-button type="submit" class="border-2 border-gray-500">{{ $question->choice4 }}</x-secondary-button>
                                </div>
                            </li>
                        </form>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>