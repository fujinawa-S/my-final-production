<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            レビュー投稿
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto py-12">
        <style>
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

        <h1 class="text-3xl font-bold mb-6">新規レビュー投稿</h1>

        @if ($errors->any())
        <div class="text-red-400">
            <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('reviews.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <div>
                <label for="work_id" class="block mb-1">作品：</label>
                <select name="work_id" id="work_id" class="review-input">
                    @foreach ($works as $work)
                    <option value="{{ $work->id }}">{{ $work->title }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="title" class="block mb-1">タイトル：</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" class="review-input" />
            </div>

            <div>
                <label for="body" class="block mb-1">本文：</label>
                <textarea name="body" id="body" rows="5" class="review-input">{{ old('body') }}</textarea>
            </div>

            <div>
                <label for="score" class="block mb-1">評価（1〜5）：</label>
                <input type="number" name="score" id="score" min="1" max="5" value="{{ old('score', 3) }}" class="review-input" />
            </div>

            <label class="inline-flex items-center space-x-2">
                <input type="checkbox" name="is_spoiler" value="1" {{ old('is_spoiler') ? 'checked' : '' }}>
                <span>ネタバレを含む</span>
            </label>

            <div>
                <label for="photos" class="block mb-1">写真（最大4枚）：</label>
                <input type="file" name="photos[]" id="photos" accept="image/*" multiple class="review-input">
                <p class="text-sm text-gray-400 mt-1">Cloudinary にアップロードされます。5MB以下の画像をご利用ください。</p>
                @error('photos')
                    <p class="text-sm text-red-400 mt-1">{{ $message }}</p>
                @enderror
                @error('photos.*')
                    <p class="text-sm text-red-400 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-md shadow hover:bg-indigo-700">
                投稿する
            </button>
        </form>

        <p class="mt-6">
            <a href="{{ route('reviews.index') }}" class="text-indigo-300 hover:underline">レビュー一覧に戻る</a>
        </p>
    </div>
</x-app-layout>
