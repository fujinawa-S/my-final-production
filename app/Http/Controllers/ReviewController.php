<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Routing\Controller;
use App\Http\Requests\StoreReviewRequest;

class ReviewController extends Controller
{
    public function store(StoreReviewRequest $request)
    {
        $validated = $request->validated();

        // Reviewモデルのインスタンスを作成し、データベースに保存する処理をここに追加
        Review::create([
            'user_id' => auth()->id(),
            'work_id' => $validated['work_id'],
            'title' => $validated['title'],
            'body' => $validated['body'],
            'score' => $validated['score'],
            'is_spoiler' => $validated['is_spoiler'] ?? false,
            'is_published' => true,
        ]);
        return redirect()->route('reviews.show', ['reviewId' => $validated['review_id']])->with('status', 'レビューを投稿しました！');
    }
}
