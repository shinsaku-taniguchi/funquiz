<x-app-layout>
    <x-slot name="header">
        <h2 class="text-center font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Welcome FunQuiz!!') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 text-center">
                    @if (Auth::check())
                    <h2>
                        <p>ようこそ、{{ Auth::user()->name }}さん</p>
                    </h2>
                    @endif

                    @can('is_admin')
                    あなたは管理者です。
                    <a href="{{ route('questions.create') }}">
                        <x-primary-button type="button">問題追加画面へ</x-primary-button>
                    </a>
                    @else
                    ボタンを押してください！
                    @endcan
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-col items-center py-6 px-4">
        <div class="mb-12">
            <a href="{{ route('start.index') }}">
                <x-primary-button type="button" class="w-full h-12">クイズへ挑戦</x-primary-button>
            </a>
        </div>
        <div class="mb-12">
            <a href="{{ route('select') }}">
                <x-primary-button type="button" class="w-full h-12">ジャンルを選択してクイズへ挑戦</x-primary-button>
            </a>
        </div>
        <div>
            <a href="{{ route('questions.index') }}">
                <x-primary-button type="button" class="w-full h-12">全問題一覧へ</x-primary-button>
            </a>
        </div>
    </div>

</x-app-layout>