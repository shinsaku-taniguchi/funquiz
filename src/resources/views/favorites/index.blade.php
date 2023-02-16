<x-app-layout>
    <x-slot name="header">
        <h2 class="text-center font-semibold text-xl text-red-800 dark:text-gray-200 leading-tight">
            これをマイページにする(一時中断)
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <ul class="flex flex-col w-full">
                        @foreach($favorites as $favorite)
                        <li class="flex w-full mb-8 border-2 border-black">
                            <div class="px-4 py-2">
                                <div x-data="{
                                    favorited: {{ in_array(request()->user()->id, $question->users->pluck('id')->all()) ? 'true' : 'false' }},
                                    async removeFavorites() {
                                        const response = await axios.post('{{ route("favorites.remove", ["question" => $question->id]) }}');
                                        this.favorited = response.data.result ? false : true;
                                    },
                                    async addFavorites() {
                                        const response = await axios.post('{{ route("favorites.add", ["question" => $question->id]) }}');
                                        this.favorited = response.data.result ? true : false;
                                    },
                                }">
                                    <template x-if="favorited">
                                        <x-secondary-button @click="await removeFavorites()" type="button" class="border-gray-800">no</x-secondary-button>
                                    </template>
                                    <template x-if="!favorited">
                                        <x-secondary-button @click="await addFavorites()" type="button" class="border-gray-800">fav</x-secondary-button>
                                    </template>
                                </div>

                                <div class="flex flex-col mt-4">
                                    <div class="flex">
                                        <div>良：</div>
                                        <div>{{ $question->reaction_good }}</div>
                                    </div>
                                    <div class="flex">
                                        <div>普：</div>
                                        <div>{{ $question->reaction_normal }}</div>
                                    </div>
                                    <div class="flex">
                                        <div>悪：</div>
                                        <div>{{ $question->reaction_bad }}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="w-full h-full">
                                <a href="{{ route('questions.show', $question) }}">
                                    <p id="question" class="w-full h-36 text-sm ml-4 py-2 px-2 whitespace-pre-wrap truncate border-l-2 border-gray-700">{{ $question->description}}</p>
                                </a>
                            </div>

                            @can('is_admin')
                            <div class="flex flex-col justify-around ml-4">
                                <div>
                                    <a href="{{ route('questions.edit', $question) }}">
                                        <x-primary-button type="button">編集</x-primary-button>
                                    </a>
                                </div>

                                <div>
                                    <form action="{{ route('questions.destroy', $question) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <x-primary-button onclick="return confirm('本当に削除しますか？')">削除</x-primary-button>
                                    </form>
                                </div>
                            </div>
                            @endcan
                        </li>
                        @endforeach
                    </ul>
                    @if(request()->routeIs('questions.index'))
                    {{ $questions->links() }}
                    @endif


                </div>
            </div>
        </div>
    </div>
</x-app-layout>