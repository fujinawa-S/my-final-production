<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            エピソード詳細
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-10 px-4 sm:px-6 lg:px-8 space-y-6">
        <style>
            .episode-card {
                background-color: #1f2430;
                border: 1px solid #363c4f;
                border-radius: 0.75rem;
                padding: 1.75rem;
                color: #f4f4f8;
            }

            .episode-meta {
                color: #a9b1d6;
            }

            .episode-tag {
                background-color: #2f3640;
                border-radius: 9999px;
                padding: 0.2rem 0.8rem;
                font-size: 0.75rem;
                color: #f4f4f8;
            }
        </style>

        @if (session('status'))
            <div class="rounded-md bg-indigo-600/20 border border-indigo-500 px-4 py-2 text-sm text-indigo-100">
                {{ session('status') }}
            </div>
        @endif

        <article class="episode-card space-y-4">
            <div class="flex flex-wrap items-start justify-between gap-3">
                <div>
                    <h1 class="text-3xl font-bold">{{ $episode->title ?? 'タイトル未設定' }}</h1>
                    <p class="episode-meta mt-2">作品：
                        <a href="{{ route('works.show', $episode->work_id) }}" class="text-indigo-300 hover:underline">
                            {{ $episode->work->title ?? '不明な作品' }}
                        </a>
                    </p>
                </div>
                <span class="episode-tag">お気に入り {{ $episode->favored_by_users_count ?? 0 }}</span>
            </div>

            <div class="grid sm:grid-cols-2 gap-4 text-sm episode-meta">
                <p>媒体：{{ $episode->media_type ?? '未設定' }}</p>
                <p>アニメ話数：{{ $episode->anime_episode_count ?? '未設定' }}</p>
                <p>漫画巻数：{{ $episode->manga_volume_count ?? '未設定' }}</p>
            </div>

            @if ($episode->summary)
                <p class="text-gray-200 whitespace-pre-line">{{ $episode->summary }}</p>
            @endif

            <div class="flex flex-wrap items-center gap-3 text-sm">
                @auth
                    <form action="{{ $alreadyFavored ? route('episodes.favorite.destroy', $episode) : route('episodes.favorite.store', $episode) }}" method="POST">
                        @csrf
                        @if ($alreadyFavored)
                            @method('DELETE')
                        @endif
                        <button type="submit" class="inline-flex items-center rounded-md border border-indigo-500 px-4 py-2 text-sm font-semibold text-indigo-200 hover:bg-indigo-500/10">
                            {{ $alreadyFavored ? 'お気に入り解除' : 'お気に入り' }}
                        </button>
                    </form>
                @else
                    <p class="episode-meta">ログインするとお気に入り登録できます。</p>
                @endauth
                <a href="{{ route('episodes.edit', $episode) }}" class="text-sm text-indigo-300 hover:underline">編集</a>
                <form action="{{ route('episodes.destroy', $episode) }}" method="POST" onsubmit="return confirm('削除してもよろしいですか？')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-sm text-red-300 hover:underline">削除</button>
                </form>
                <a href="{{ route('episodes.index') }}" class="text-sm text-gray-300 hover:text-white">一覧へ戻る</a>
            </div>
        </article>
    </div>
</x-app-layout>