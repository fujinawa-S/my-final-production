<!DOCTYPE html>
<html lang="ja">


<head>
    <meta charset="UTF-8">
    <title>レビュー一覧</title>
</head>

<body>
    <h1>レビュー一覧</h1>

    @if (session('status'))
    <p style="color:green;">{{ session('status') }}</p>
    @endif

    <a href="{{ route('reviews.create') }}"> ＋新規レビュー投稿</a>

    <hr>

    @if ($reviews->count() === 0)
    <p>まだレビューがありません。</p>
    @else
    @foreach ($reviews as $review)
    <div style="margin-bottom: 20px;">
        <h2>
            <a href="{{ route('reviews.show', ['review' => $review->id]) }}">
                {{ $review->title }}
            </a>
        </h2>
        <p>作品名：{{ $review->work->title ?? '不明' }}</p>
        <p>評価：{{ $review->score }}/5</p>
        <p>{{ Str::limit($review->body, 100) }}</p>
        <p>投稿者：{{ $review->user->name ?? 'ゲスト' }}</p>

        <a href="{{ route('reviews.edit', ['review' => $review->id]) }}">編集</a> |
        <form action="{{ route('reviews.delete', ['review' => $review->id]) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('削除しますか？')">削除</button>
        </form>
    </div>
    @endforeach
    @endif
</body>

</html>