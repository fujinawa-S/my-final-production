<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>レビュー詳細</title>
</head>

<body>
    <h1>レビュー詳細</h1>

    @if (session('status'))
    <p style="color:green;">{{ session('status') }}</p>
    @endif

    <h2>{{ $review->title }}</h2>

    <p>作品名：{{ $review->work->title ?? '不明' }}</p>
    <p>評価：{{ $review->score }}/5</p>

    @if ($review->is_spoiler)
    <p style="color:red;">※このレビューにはネタバレが含まれます</p>
    @endif

    <p>{{ $review->body }}</p>

    <hr>

    <p>投稿者：{{ $review->user->name ?? 'ゲスト' }}</p>
    <p>投稿日：{{ $review->created_at->format('Y年m月d日 H:i') }}</p>

    <hr>

    <a href="{{ route('reviews.edit', ['review' => $review->id]) }}">編集する</a> |
    <form action="{{ route('reviews.delete', ['review' => $review->id]) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('本当に削除しますか？')">削除</button>
    </form> |
    <a href="{{ route('reviews.index') }}">一覧に戻る</a>
</body>

</html>