<x-app-layout>
    <x-slot name="header">
        <h2 class="text-center font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            解答
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="">
                    <div class="p-6 text-gray-900 dark:text-gray-100">

                        @if($isCorrect)
                        <p class="text-center font-semibold text-xl">正解です！！</p>
                        @else
                        <p class="text-center font-semibold text-xl">残念、不正解です、、、</p>
                        @endif

                        <div class="flex flex-col items-center">
                            <div>
                                <div class="mt-8 mx-auto mb-2 w-fit">解説</div>
                                <div class="mx-auto p-4 w-full h-full border-2 border-gray-400">
                                    @if(empty($question->answer_description))
                                    <p>
                                        この問題には解説がまだありません。
                                    </p>
                                    @else
                                    <p>
                                        {{ $question->answer_description }}
                                    </p>
                                    @endif
                                </div>
                            </div>

                            <div class="my-8" x-data="{
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
                                    <x-primary-button @click="await removeFavorites()" type="button" class="border-gray-800">お気に入りから外す</x-primary-button>
                                </template>
                                <template x-if="!favorited">
                                    <x-primary-button @click="await addFavorites()" type="button" class="border-gray-800">お気に入りに追加</x-primary-button>
                                </template>
                            </div>
                           
                            <p>今のクイズはいかがでしたか？</p>
                            <div x-data="Reaction()">
                                <template x-if="reactionId === 3">
                                    <x-primary-button @click="await toggleReaction(null)" type="button" class="bg-sky-500/100 hover:bg-sky-500/100">悪問</x-primary-button>
                                </template>
                                <template x-if="reactionId !== 3">
                                    <x-primary-button @click="await toggleReaction(3)" type="button">悪問</x-primary-button>
                                </template>
                                <template x-if="reactionId === 2">
                                    <x-primary-button @click="await toggleReaction(null)" class="mx-8 bg-sky-500/100 hover:bg-sky-500/100" type="button">普通</x-primary-button>
                                </template>
                                <template x-if="reactionId !== 2">
                                    <x-primary-button @click="await toggleReaction(2)" class="mx-8" type="button">普通</x-primary-button>
                                </template>
                                <template x-if="reactionId === 1">
                                    <x-primary-button @click="await toggleReaction(null)" type="button" class="bg-sky-500/100 hover:bg-sky-500/100">良問</x-primary-button>
                                </template>
                                <template x-if="reactionId !== 1">
                                    <x-primary-button @click="await toggleReaction(1)" type="button">良問</x-primary-button>
                                </template>
                            </div>

                            <script>
                                function Reaction() {
                                    return {
                                        reactionId: null,
                                        async toggleReaction(reaction_id) {
                                            const response = await axios.post('{{ route("reactions.toggle", ["question" => $question->id]) }}', {
                                                reaction_id: reaction_id
                                            });
                                            console.log(response.data);
                                            this.reactionId = response.data.reactionId;
                                        },
                                    }
                                }
                            </script>
                        </div>

                        <div class="w-fit mx-auto my-8">
                            <a href="{{ route('dashboard') }}">
                                <x-primary-button type="button">やめる</x-primary-button>
                            </a>

                            <a href="{{ route('start.index', ['next' => 1]) }}">
                                <x-primary-button type="button" class="ml-8">次へ</x-primary-button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>