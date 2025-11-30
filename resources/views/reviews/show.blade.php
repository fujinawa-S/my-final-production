<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            レビュー詳細
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

            .review-meta {
                color: #a9b1d6;
            }

            .review-tag {
                background-color: #2f3640;
                border-radius: 9999px;
                padding: 0.2rem 0.8rem;
                font-size: 0.75rem;
                color: #f4f4f8;
            }

            .comment-card {
                background-color: #252b38;
                border-radius: 0.75rem;
                border: 1px solid #3b4358;
                padding: 1rem 1.25rem;
                color: #e5e7ef;
            }

            .comment-input {
                background-color: #2f3640;
                color: #ffffff;
                border: 1px solid #4a4f63;
                border-radius: 0.375rem;
                width: 100%;
                padding: 0.75rem;
                box-sizing: border-box;
            }

            .comment-input::placeholder {
                color: rgba(255, 255, 255, 0.7);
            }
        </style>

        @if (session('status'))
            <div class="rounded-md bg-indigo-600/20 border border-indigo-500 px-4 py-2 text-sm text-indigo-100">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="rounded-md bg-red-500/20 border border-red-400 px-4 py-2 text-sm text-red-100">
                <ul class="list-disc ps-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <article class="review-card space-y-5">
            <div class="flex flex-wrap items-start justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-bold">{{ $review->title }}</h1>
                    <p class="review-meta mt-2">作品：{{ $review->work->title ?? '不明' }} / 評価：{{ $review->score }}/5</p>
                </div>
                <span class="review-tag">お気に入り {{ $review->favored_by_count ?? 0 }}</span>
            </div>

            @if ($review->is_spoiler)
                <p class="text-sm text-red-400 flex items-center gap-2">
                    <span class="review-tag bg-red-500/30 text-red-100">注意</span>
                    このレビューにはネタバレが含まれています。
                </p>
            @endif

            <p class="leading-relaxed text-lg whitespace-pre-line">
                {{ $review->body }}
            </p>

            @if ($review->photos->isNotEmpty())
                <div class="grid gap-3 sm:grid-cols-2">
                    @foreach ($review->photos as $photo)
                        <img src="{{ $photo->url }}" alt="レビュー写真" class="w-full h-48 object-cover rounded-lg border border-[#2f3640]" />
                    @endforeach
                </div>
            @endif

            <div class="flex flex-wrap items-center gap-3">
                <form action="{{ $alreadyFavored ? route('reviews.favorite.destroy', $review) : route('reviews.favorite.store', $review) }}" method="POST">
                    @csrf
                    @if ($alreadyFavored)
                        @method('DELETE')
                    @endif
                    <button type="submit" class="inline-flex items-center rounded-md border border-indigo-500 px-4 py-2 text-sm font-semibold text-indigo-200 hover:bg-indigo-500/10">
                        {{ $alreadyFavored ? 'お気に入り解除' : 'お気に入り' }}
                    </button>
                </form>
                <a href="{{ route('reviews.edit', $review) }}" class="text-sm text-indigo-200 hover:underline">編集</a>
                <form action="{{ route('reviews.delete', $review) }}" method="POST" onsubmit="return confirm('削除してもよろしいですか？')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-sm text-red-300 hover:underline">削除</button>
                </form>
                <a href="{{ route('reviews.index') }}" class="text-sm text-gray-300 hover:text-white">一覧へ戻る</a>
            </div>
        </article>

        <section class="review-card space-y-4">
            <h3 class="text-2xl font-semibold">コメント一覧</h3>
            @if ($review->comments->isEmpty())
                <p class="review-meta">まだコメントはありません。</p>
            @else
                <div class="space-y-3">
                    @foreach ($review->comments as $comment)
                        <div class="comment-card space-y-2">
                            <p>{{ $comment->body }}</p>
                            <div class="text-sm text-gray-400 flex items-center gap-2">
                                <span>投稿者：{{ $comment->user->name ?? 'ゲスト' }}</span>
                                <span>/ {{ $comment->created_at->format('Y-m-d H:i') }}</span>
                            </div>
                            @if (auth()->id() === $comment->user_id)
                                <form action="{{ route('reviews.comments.destroy', ['review' => $review->id, 'comment' => $comment->id]) }}" method="POST" onsubmit="return confirm('コメントを削除してもよろしいですか？')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-sm text-red-300 hover:underline">削除</button>
                                </form>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        </section>

        <section class="review-card space-y-4">
            <h3 class="text-2xl font-semibold">コメントを投稿する</h3>

            @if ($errors->comment ?? false)
                <div class="rounded-md bg-red-500/20 border border-red-400 px-4 py-2 text-sm text-red-100">
                    <ul class="list-disc ps-5 space-y-1">
                        @foreach (($errors->comment ?? collect())->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('reviews.comments.store', $review->id) }}" method="POST" class="space-y-4">
                @csrf
                <textarea name="body" rows="4" class="comment-input" placeholder="コメントを入力してください">{{ old('body') }}</textarea>
                <button type="submit" class="inline-flex items-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-slate-900">
                    コメントする
                </button>
            </form>
        </section>
    </div>
</x-app-layout>
