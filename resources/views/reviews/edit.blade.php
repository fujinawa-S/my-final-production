<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            レビュー編集
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto py-10 px-4 sm:px-6 lg:px-8 space-y-6">
        <style>
            .review-card {
                background-color: #1f2430;
                border: 1px solid #363c4f;
                border-radius: 0.75rem;
                padding: 1.75rem;
                color: #f4f4f8;
            }

            .review-input {
                background-color: #2f3640;
                color: #ffffff;
                border: 1px solid #4a4f63;
                border-radius: 0.375rem;
                padding: 0.5rem 0.75rem;
                width: 100%;
                box-sizing: border-box;
            }

            .review-input::placeholder {
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

        <div class="review-card">
            <form action="{{ route('reviews.update', $review) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label for="work_id" class="block text-sm font-medium text-gray-300 mb-1">作品</label>
                    <select name="work_id" id="work_id" class="review-input">
                        @foreach ($works as $work)
                            <option value="{{ $work->id }}" @selected(old('work_id', $review->work_id) == $work->id)>{{ $work->title }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="title" class="block text-sm font-medium text-gray-300 mb-1">タイトル</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $review->title) }}" class="review-input" />
                </div>

                <div>
                    <label for="body" class="block text-sm font-medium text-gray-300 mb-1">本文</label>
                    <textarea name="body" id="body" rows="6" class="review-input">{{ old('body', $review->body) }}</textarea>
                </div>

                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label for="score" class="block text-sm font-medium text-gray-300 mb-1">評価（1〜5）</label>
                        <input type="number" name="score" id="score" min="1" max="5" value="{{ old('score', $review->score) }}" class="review-input" />
                    </div>
                    <div class="flex items-center space-x-2 mt-6 sm:mt-0">
                        <input type="checkbox" name="is_spoiler" id="is_spoiler" value="1" class="rounded border-gray-500 text-indigo-400 focus:ring-indigo-400" @checked(old('is_spoiler', $review->is_spoiler)) />
                        <label for="is_spoiler" class="text-sm text-gray-300">ネタバレを含む</label>
                    </div>
                </div>

                <div class="space-y-3">
                    <p class="text-sm text-gray-300">現在登録されている写真（{{ $review->photos->count() }} / 4）</p>
                    @if ($review->photos->isEmpty())
                        <p class="text-sm text-gray-400">まだ写真はありません。</p>
                    @else
                        <div class="grid grid-cols-2 gap-3">
                            @foreach ($review->photos as $photo)
                                <img src="{{ $photo->url }}" alt="レビュー写真" class="rounded-lg object-cover w-full h-32 border border-[#2f3640]" />
                            @endforeach
                        </div>
                    @endif
                </div>

                <div>
                    <label for="photos" class="block text-sm font-medium text-gray-300 mb-1">写真を追加（最大4枚まで）</label>
                    <input type="file" name="photos[]" id="photos" accept="image/*" multiple class="review-input">
                    <p class="text-sm text-gray-400 mt-1">Cloudinary に保存されます。5MB以下の画像を選択してください。</p>
                    @error('photos')
                        <p class="text-sm text-red-400 mt-1">{{ $message }}</p>
                    @enderror
                    @error('photos.*')
                        <p class="text-sm text-red-400 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-end gap-3">
                    <a href="{{ route('reviews.show', $review) }}" class="text-sm text-gray-300 hover:text-white">詳細に戻る</a>
                    <button type="submit" class="inline-flex items-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-slate-900">
                        更新する
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
