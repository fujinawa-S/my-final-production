<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>レビュー編集</title>
</head>

<body>
    <h1>レビュー編集</h1>

    @if ($errors->any())
    <div style="color:red;">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('reviews.store') }}" method="POST">
        @csrf
        @method('PUT')

        <label for="work_id">作品名：</label><br>
        <select name="work_id" id="work_id">
            @foreach ($works as $work)
            <option value="{{ $work->id }}" {{ $work->id == $review->work_id ? 'selected' : '' }}>
                {{ $work->title }}
            </option>
            @endforeach
        </select><br><br>

        <label for="title">タイトル：</label><br>
        <input type="text" name="title" id="title" value="{{ old('title', $review->title) }}"><br><br>

        <label for="body">本文：</label><br>
        <textarea name="body" id="body" rows="5" cols="40">{{ old('body', $review->body) }}</textarea><br><br>

        <label for="score">評価（1〜5）：</label><br>
        <input type="number" name="score" id="score" min="1" max="5" value="{{ old('score', $review->score) }}"><br><br>

        <label>
            <input type="checkbox" name="is_spoiler" value="1" {{ old('is_spoiler', $review->is_spoiler) ? 'checked' : '' }}>
            ネタバレを含む
        </label><br><br>

        <button type="submit">更新する</button>
    </form>

    <p><a href="{{ route('reviews.show', ['review' => $review->id]) }}">← 詳細に戻る</a></p>
</body>

</html>