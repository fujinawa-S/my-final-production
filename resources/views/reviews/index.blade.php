<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            レビュー一覧
        </h2>
    </x-slot>

    <div class="max-w-5xl mx-auto py-10 px-4 sm:px-6 lg:px-8 space-y-6">
        <style>
            .list-card {
                background-color: #1f2430;
                border: 1px solid #363c4f;
                border-radius: 0.75rem;
                padding: 1.5rem;
                color: #f4f4f8;
            }

            .list-meta {
                color: #a9b1d6;
            }

            .list-tag {
                background-color: #2f3640;
                border-radius: 9999px;
                padding: 0.2rem 0.8rem;
                font-size: 0.75rem;
                color: #f4f4f8;
            }

            .list-button {
                display: inline-flex;
                align-items: center;
                border-radius: 0.5rem;
                padding: 0.5rem 1rem;
                font-size: 0.875rem;
                font-weight: 600;
            }
        </style>

        @if (session('status'))
            <div class="rounded-md bg-indigo-600/20 border border-indigo-500 px-4 py-2 text-sm text-indigo-100">
                {{ session('status') }}
            </div>
        @endif

        <div class="flex justify-end">
            <a href="{{ route('reviews.create') }}" class="list-button bg-indigo-600 text-white shadow hover:bg-indigo-700">
                ＋ 新規レビュー投稿
            </a>
        </div>

        @if ($reviews->isEmpty())
            <p class="list-meta">まだレビューはありません。</p>
        @else
            <div class="space-y-4">
                @foreach ($reviews as $review)
                    <article class="list-card space-y-3">
                        <div class="flex flex-wrap items-center justify-between gap-3">
                            <h3 class="text-2xl font-bold">
                                <a href="{{ route('reviews.show', $review) }}" class="hover:underline">
                                    {{ $review->title }}
                                </a>
                            </h3>
                            <span class="list-tag">お気に入り {{ $review->favored_by_count ?? 0 }}</span>
                        </div>
                        <p class="list-meta">作品：{{ $review->work->title ?? '不明' }} / 評価：{{ $review->score }}/5</p>
                        <p class="text-gray-200">{{ Str::limit($review->body, 120) }}</p>
                        <div class="flex flex-wrap items-center gap-3 text-sm">
                            <a href="{{ route('reviews.edit', $review) }}" class="text-indigo-300 hover:underline">編集</a>
                            <form action="{{ route('reviews.delete', $review) }}" method="POST" onsubmit="return confirm('削除してもよろしいですか？')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-300 hover:underline">削除</button>
                            </form>
                            <span class="text-xs text-gray-500">投稿日時：{{ $review->created_at->format('Y/m/d H:i') }}</span>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
