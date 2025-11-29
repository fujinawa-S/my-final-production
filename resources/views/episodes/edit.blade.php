<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            エピソード編集
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto py-10 px-4 sm:px-6 lg:px-8 space-y-6">
        @if ($errors->any())
            <div class="rounded-md bg-red-50 p-4 text-sm text-red-800">
                <ul class="list-disc ms-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white shadow rounded-lg p-6">
            <form action="{{ route('episodes.update', $episode) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label for="work_id" class="block text-sm font-medium text-gray-700">作品</label>
                    <select name="work_id" id="work_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @foreach ($works as $work)
                            <option value="{{ $work->id }}" @selected(old('work_id', $episode->work_id) == $work->id)>{{ $work->title }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">タイトル</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $episode->title) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                </div>

                <div>
                    <label for="summary" class="block text-sm font-medium text-gray-700">概要</label>
                    <textarea name="summary" id="summary" rows="5" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('summary', $episode->summary) }}</textarea>
                </div>

                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label for="anime_episode_count" class="block text-sm font-medium text-gray-700">アニメ話数</label>
                        <input type="number" name="anime_episode_count" id="anime_episode_count" min="0" value="{{ old('anime_episode_count', $episode->anime_episode_count) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                    </div>
                    <div>
                        <label for="manga_volume_count" class="block text-sm font-medium text-gray-700">原作巻数</label>
                        <input type="number" name="manga_volume_count" id="manga_volume_count" min="0" value="{{ old('manga_volume_count', $episode->manga_volume_count) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                    </div>
                </div>

                <div>
                    <label for="media_type" class="block text-sm font-medium text-gray-700">媒体区分</label>
                    <select name="media_type" id="media_type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="" @selected(old('media_type', $episode->media_type) === null)>未設定</option>
                        <option value="anime" @selected(old('media_type', $episode->media_type) === 'anime')>アニメ</option>
                        <option value="manga" @selected(old('media_type', $episode->media_type) === 'manga')>マンガ</option>
                        <option value="both" @selected(old('media_type', $episode->media_type) === 'both')>アニメ・マンガ両方</option>
                    </select>
                </div>

                <div class="flex items-center justify-end space-x-3">
                    <a href="{{ route('episodes.show', $episode) }}" class="text-sm text-gray-600 hover:text-gray-900">詳細へ戻る</a>
                    <button type="submit" class="inline-flex items-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        更新する
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
