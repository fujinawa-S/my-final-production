<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            作品一覧
        </h2>
    </x-slot>

    <div class="max-w-5xl mx-auto py-10 px-4 sm:px-6 lg:px-8 space-y-6">
        <style>
            .work-card {
                background-color: #1f2430;
                border: 1px solid #363c4f;
                border-radius: 0.75rem;
                padding: 1.5rem;
                color: #f4f4f8;
            }

            .work-meta {
                color: #a9b1d6;
            }

            .work-tag {
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

        @if ($works->isEmpty())
            <p class="work-meta">まだ作品は登録されていません。</p>
        @else
            <div class="space-y-4">
                @foreach ($works as $work)
                    <article class="work-card space-y-2">
                        <div class="flex flex-wrap items-center justify-between gap-3">
                            <h3 class="text-2xl font-bold">
                                <a href="{{ route('works.show', $work->id) }}" class="hover:underline text-white">{{ $work->title }}</a>
                            </h3>
                            <span class="work-tag">お気に入り {{ $work->favored_by_users_count ?? 0 }}</span>
                        </div>
                        <p class="work-meta">著者：{{ $work->author->name ?? '不明' }} / ジャンル：{{ $work->genre->name ?? '不明' }}</p>
                        <p class="work-meta">出版社：{{ $work->publisher->name ?? '不明' }}</p>
                        <div class="flex flex-wrap items-center gap-3 text-sm">
                            @auth
                                @php
                                    $isFavored = in_array($work->id, $favoriteWorkIds ?? [], true);
                                @endphp
                                <form action="{{ $isFavored ? route('works.favorite.destroy', $work) : route('works.favorite.store', $work) }}" method="POST">
                                    @csrf
                                    @if ($isFavored)
                                        @method('DELETE')
                                    @endif
                                    <button type="submit" class="text-indigo-300 hover:underline">
                                        {{ $isFavored ? 'お気に入り解除' : 'お気に入り' }}
                                    </button>
                                </form>
                            @endauth
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
