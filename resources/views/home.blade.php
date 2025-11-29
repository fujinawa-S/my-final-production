<x-app-layout>
    <div class="min-h-screen bg-gradient-to-b from-gray-950 via-gray-900 to-gray-800 text-gray-100">
        <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8 space-y-10">
            <section class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-amber-600 via-rose-600 to-indigo-700 shadow-2xl">
                <div class="absolute inset-0 bg-gradient-to-r from-black/70 via-black/30 to-transparent"></div>
                <div class="relative z-10 flex flex-col justify-center gap-4 px-8 py-10 lg:px-12 text-white">
                    <p class="text-sm uppercase tracking-widest text-amber-200">Anime & Manga Hub</p>
                    <h1 class="text-3xl sm:text-4xl font-bold leading-tight">お気に入りの作品を保存して、今夜の視聴リストを作ろう</h1>
                    <p class="text-sm text-amber-100 max-w-2xl">話題のアニメ・マンガをチェックして、レビューやお気に入りをどんどん追加しましょう。</p>
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('reviews.create') }}"
                            class="inline-flex items-center rounded-full bg-white px-5 py-2 text-sm font-semibold text-amber-600 shadow hover:bg-amber-50">
                            レビューを投稿する
                        </a>
                        <a href="{{ route('works.index') }}"
                            class="inline-flex items-center rounded-full border border-white px-5 py-2 text-sm font-semibold text-white hover:bg-white/10">
                            作品一覧を見る
                        </a>
                    </div>
                </div>
                <div class="absolute inset-y-0 right-0 w-1/2 opacity-40 bg-[url('https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=1200&q=80')] bg-cover bg-center"></div>
            </section>

            <section class="space-y-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-2xl font-semibold text-white">注目の作品</h2>
                    <a href="{{ route('works.index') }}" class="text-sm text-cyan-400 hover:text-cyan-200">すべて見る</a>
                </div>
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @forelse ($featuredWorks as $work)
                    <article class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 border border-gray-800 rounded-2xl shadow-lg p-4 space-y-3">
                        <div class="text-xs uppercase tracking-widest text-cyan-300">FEATURED</div>
                        <h3 class="text-lg font-semibold text-white">{{ $work->title }}</h3>
                        <p class="text-sm text-gray-400">著者：{{ $work->author->name ?? '情報なし' }}</p>
                        <p class="text-sm text-gray-300 line-clamp-3">{{ $work->summary ?? '紹介文は準備中です。' }}</p>
                        <div class="flex items-center justify-between text-xs text-gray-400">
                            <span>いいね {{ $work->favored_by_users_count ?? 0 }}</span>
                            <a href="{{ route('works.show', $work) }}" class="text-cyan-400 hover:underline">詳細を見る</a>
                        </div>
                    </article>
                    @empty
                    <p class="text-gray-400">表示する作品がありません。</p>
                    @endforelse
                </div>
            </section>

            <section class="space-y-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-semibold text-white">アニメ注目タイトル</h2>
                    <a href="{{ route('works.index') }}" class="text-sm text-cyan-400 hover:text-cyan-200">もっと見る</a>
                </div>
                <div class="bg-gray-900/70 border border-gray-800 rounded-2xl px-4 py-4">
                    <div class="overflow-x-auto">
                        <div class="flex gap-4 min-w-full pb-2">
                            @forelse ($animeWorks as $work)
                            <article class="min-w-[220px] bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 border border-gray-800 rounded-2xl shadow p-4 space-y-2">
                                <div class="text-[10px] uppercase tracking-widest text-indigo-300">ANIME</div>
                                <p class="text-sm font-semibold text-white truncate">{{ $work->title }}</p>
                                <p class="text-xs text-gray-400">著者：{{ $work->author->name ?? '不明' }}</p>
                                <p class="text-xs text-gray-500 line-clamp-2">{{ $work->summary ?? '紹介文は準備中です。' }}</p>
                            </article>
                            @empty
                            <p class="text-gray-400">アニメ作品が見つかりませんでした。</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </section>

            <section class="space-y-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-semibold text-white">マンガ注目タイトル</h2>
                    <a href="{{ route('works.index') }}" class="text-sm text-cyan-400 hover:text-cyan-200">もっと見る</a>
                </div>
                <div class="bg-gray-900/70 border border-gray-800 rounded-2xl px-4 py-4">
                    <div class="overflow-x-auto">
                        <div class="flex gap-4 min-w-full pb-2">
                            @forelse ($mangaWorks as $work)
                            <article class="min-w-[220px] bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 border border-gray-800 rounded-2xl shadow p-4 space-y-2">
                                <div class="text-[10px] uppercase tracking-widest text-pink-300">MANGA</div>
                                <p class="text-sm font-semibold text-white truncate">{{ $work->title }}</p>
                                <p class="text-xs text-gray-400">著者：{{ $work->author->name ?? '不明' }}</p>
                                <p class="text-xs text-gray-500 line-clamp-2">{{ $work->summary ?? '紹介文は準備中です。' }}</p>
                            </article>
                            @empty
                            <p class="text-gray-400">マンガ作品が見つかりませんでした。</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
