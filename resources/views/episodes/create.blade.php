<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            エピソード投稿
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto py-10 px-4 sm:px-6 lg:px-8 space-y-6">
        <style>
            .episode-card {
                background-color: #1f2430;
                border: 1px solid #363c4f;
                border-radius: 0.75rem;
                padding: 1.75rem;
                color: #f4f4f8;
            }

            .episode-input {
                background-color: #2f3640;
                color: #ffffff;
                border: 1px solid #4a4f63;
                border-radius: 0.375rem;
                padding: 0.5rem 0.75rem;
                width: 100%;
                box-sizing: border-box;
            }

            .episode-input::placeholder {
                color: rgba(255, 255, 255, 0.7);
            }
        </style>

        @if ($errors->any())
            <div class="rounded-md bg-red-500/20 border border-red-400 px-4 py-2 text-sm text-red-100">
                <ul class="list-disc ps-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="episode-card">
            <form action="{{ route('episodes.store') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label for="work_id" class="block text-sm font-medium text-gray-300 mb-1">作品</label>
                    <select name="work_id" id="work_id" class="episode-input">
                        @foreach ($works as $work)
                            <option value="{{ $work->id }}" {{ old('work_id') == $work->id ? 'selected' : '' }}>
                                {{ $work->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="title" class="block text-sm font-medium text-gray-300 mb-1">タイトル</label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}" class="episode-input" />
                </div>

                <div>
                    <label for="summary" class="block text-sm font-medium text-gray-300 mb-1">概要</label>
                    <textarea id="summary" name="summary" rows="5" class="episode-input">{{ old('summary') }}</textarea>
                </div>

                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label for="anime_episode_count" class="block text-sm font-medium text-gray-300 mb-1">アニメ話数</label>
                        <input type="number" id="anime_episode_count" name="anime_episode_count" min="0" value="{{ old('anime_episode_count') }}" class="episode-input" />
                    </div>
                    <div>
                        <label for="manga_volume_count" class="block text-sm font-medium text-gray-300 mb-1">漫画巻数</label>
                        <input type="number" id="manga_volume_count" name="manga_volume_count" min="0" value="{{ old('manga_volume_count') }}" class="episode-input" />
                    </div>
                </div>

                <div>
                    <label for="media_type" class="block text-sm font-medium text-gray-300 mb-1">媒体種別</label>
                    <select name="media_type" id="media_type" class="episode-input">
                        <option value="" {{ old('media_type') === null ? 'selected' : '' }}>未設定</option>
                        <option value="anime" {{ old('media_type') === 'anime' ? 'selected' : '' }}>アニメ</option>
                        <option value="manga" {{ old('media_type') === 'manga' ? 'selected' : '' }}>漫画</option>
                        <option value="both" {{ old('media_type') === 'both' ? 'selected' : '' }}>アニメ・漫画両方</option>
                    </select>
                </div>

                <div class="flex items-center justify-end gap-3">
                    <a href="{{ route('episodes.index') }}" class="text-sm text-gray-300 hover:text-white">一覧へ戻る</a>
                    <button type="submit" class="inline-flex items-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-slate-900">
                        投稿する
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>