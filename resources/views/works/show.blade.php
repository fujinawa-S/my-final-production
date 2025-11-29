<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            作品詳細
        </h2>
    </x-slot>

    <div class="max-w-5xl mx-auto py-10 px-4 sm:px-6 lg:px-8 space-y-8">
        <style>
            .work-card {
                background-color: #1f2430;
                border: 1px solid #363c4f;
                border-radius: 1rem;
                padding: 1.75rem;
                color: #f4f4f8;
            }

            .work-meta {
                color: #a9b1d6;
            }

            .work-tag {
                background-color: #2f3640;
                border-radius: 9999px;
                padding: 0.25rem 0.9rem;
                font-size: 0.75rem;
                color: #f4f4f8;
            }

            .work-button {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                border-radius: 0.75rem;
                padding: 0.65rem 1rem;
                font-weight: 600;
                font-size: 0.9rem;
            }

            .episode-card,
            .sub-card {
                background-color: #252b38;
                border: 1px solid #3b4358;
                border-radius: 0.9rem;
                padding: 1.25rem;
                color: #e6e9f5;
            }
        </style>

        <section class="work-card space-y-6">
            <div class="grid lg:grid-cols-[220px_1fr] gap-8">
                <div class="space-y-4">
                    <div class="w-full rounded-xl overflow-hidden border border-[#2d3547]">
                        <img src="{{ $work->image ? asset('storage/'.$work->image) : 'https://res.cloudinary.com/demo/image/upload/v1312461204/sample.jpg' }}" alt="{{ $work->title }}" class="w-full h-full object-cover">
                    </div>
                    <a href="{{ route('episodes.create') }}" class="work-button bg-indigo-600 text-white hover:bg-indigo-700 w-full">
                        ＋ エピソードを追加
                    </a>
                    <form action="{{ $alreadyFavored ? route('works.favorite.destroy', $work) : route('works.favorite.store', $work) }}" method="POST">
                        @csrf
                        @if ($alreadyFavored)
                            @method('DELETE')
                        @endif
                        <button type="submit" class="work-button border border-indigo-400 text-indigo-200 hover:bg-indigo-500/10 w-full">
                            {{ $alreadyFavored ? 'お気に入り解除' : 'お気に入りに登録' }}
                        </button>
                    </form>
                </div>

                <div class="space-y-3">
                    <div class="flex items-center gap-3 text-sm">
                        <span class="work-tag">{{ $work->genre->name ?? 'ジャンル未設定' }}</span>
                        <span class="work-meta">お気に入り {{ $work->favored_by_users_count ?? 0 }}</span>
                    </div>
                    <h1 class="text-3xl font-semibold">{{ $work->title }}</h1>
                    <p class="work-meta">著者：{{ $work->author->name ?? '不明' }}</p>
                    <p class="work-meta">出版社：{{ $work->publisher->name ?? '不明' }}</p>
                    <p class="work-meta">連載状況：{{ $work->serialization_status ?? '不明' }}</p>
                    <p class="text-gray-200 whitespace-pre-line mt-4">{{ $work->summary ?? '作品概要は準備中です。' }}</p>
                </div>
            </div>
        </section>

        <section class="space-y-4">
            <div class="flex items-center justify-between">
                <h2 class="text-2xl font-semibold text-white">エピソード</h2>
                <a href="{{ route('episodes.index') }}" class="text-sm text-indigo-300 hover:text-white">一覧へ</a>
            </div>
            <div class="grid gap-4 md:grid-cols-2">
                @forelse ($work->episodes as $episode)
                    <article class="episode-card space-y-2">
                        <p class="text-xs work-meta">Ep.{{ $loop->iteration }}</p>
                        <h3 class="text-lg font-semibold">{{ $episode->title ?? 'タイトル未設定' }}</h3>
                        <p class="text-sm text-gray-300 line-clamp-3">{{ $episode->summary ?? '概要は準備中です。' }}</p>
                    </article>
                @empty
                    <p class="work-meta">まだエピソードは登録されていません。</p>
                @endforelse
            </div>
        </section>

        <section class="space-y-4">
            <div class="flex items-center justify-between">
                <h2 class="text-2xl font-semibold text-white">ユーザーレビュー</h2>
                <a href="{{ route('reviews.index') }}" class="text-sm text-indigo-300 hover:text-white">もっと見る</a>
            </div>
            <div class="space-y-4">
                @forelse ($work->reviews as $review)
                    <article class="sub-card space-y-2">
                        <div class="flex items-center justify-between text-sm work-meta">
                            <span>{{ $review->user->name ?? 'ユーザー' }}</span>
                            <span>評価：{{ $review->score }}/5</span>
                        </div>
                        <p class="text-gray-200">{{ Str::limit($review->body, 150) }}</p>
                    </article>
                @empty
                    <p class="work-meta">まだレビューはありません。</p>
                @endforelse
            </div>
        </section>
    </div>
</x-app-layout>