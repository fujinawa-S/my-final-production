<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            エピソード一覧
        </h2>
    </x-slot>

    <div class="max-w-5xl mx-auto py-10 px-4 sm:px-6 lg:px-8 space-y-6">
        <style>
            .episode-card {
                background-color: #1f2430;
                border: 1px solid #363c4f;
                border-radius: 0.75rem;
                padding: 1.5rem;
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

            .episode-button {
                display: inline-flex;
                align-items: center;
                border-radius: 0.5rem;
                padding: 0.4rem 0.9rem;
                font-size: 0.85rem;
                font-weight: 600;
            }
        </style>

        @if (session('status'))
            <div class="rounded-md bg-indigo-600/20 border border-indigo-500 px-4 py-2 text-sm text-indigo-100">
                {{ session('status') }}
            </div>
        @endif

        @auth
            <div class="flex justify-end">
                <a href="{{ route('episodes.create') }}" class="episode-button bg-indigo-600 text-white shadow hover:bg-indigo-700">
                    ＋ 新規エピソード投稿
                </a>
            </div>
        @endauth

        @if ($episodes->isEmpty())
            <p class="episode-meta">まだエピソードはありません。</p>
        @else
            <div class="space-y-4">
                @foreach ($episodes as $episode)
                    <article class="episode-card space-y-2">
                        <div class="flex flex-wrap items-center justify-between gap-3">
                            <h3 class="text-2xl font-bold">
                                <a href="{{ route('episodes.show', $episode) }}" class="hover:underline text-white">
                                    {{ $episode->title ?? 'タイトル未設定' }}
                                </a>
                            </h3>
                            <span class="episode-tag">お気に入り {{ $episode->favored_by_users_count ?? 0 }}</span>
                        </div>
                        <p class="episode-meta">作品：{{ $episode->work->title ?? '不明な作品' }} / 媒体：{{ $episode->media_type ?? '未設定' }}</p>
                        <div class="flex flex-wrap items-center gap-3 text-sm">
                            @auth
                                @php
                                    $favoriteIds = $favoriteEpisodeIds ?? [];
                                    $isFavored = in_array($episode->id, $favoriteIds, true);
                                @endphp
                                <form action="{{ $isFavored ? route('episodes.favorite.destroy', $episode) : route('episodes.favorite.store', $episode) }}" method="POST">
                                    @csrf
                                    @if ($isFavored)
                                        @method('DELETE')
                                    @endif
                                    <button type="submit" class="inline-flex items-center rounded-md border border-indigo-500 px-4 py-2 text-sm font-semibold text-indigo-200 hover:bg-indigo-500/10">
                                        {{ $isFavored ? 'お気に入り解除' : 'お気に入り' }}
                                    </button>
                                </form>
                                <a href="{{ route('episodes.edit', $episode) }}" class="text-indigo-300 hover:underline">編集</a>
                                <form action="{{ route('episodes.destroy', $episode) }}" method="POST" onsubmit="return confirm('削除してもよろしいですか？')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-300 hover:underline">削除</button>
                                </form>
                            @else
                                <p class="episode-meta">ログインするとお気に入り登録ができます。</p>
                            @endauth
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>