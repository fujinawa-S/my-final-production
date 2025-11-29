<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use App\Models\Review;
use App\Models\Work;

class ReviewController extends Controller
{
    /**
     * レビューの一覧を表示
     */
    public function index()
    {
        $reviews = Review::with(['user', 'work'])
            ->withCount('favoredBy')
            ->latest()
            ->get();

        $favoriteReviewIds = [];
        if (auth()->check()) {
            $favoriteReviewIds = auth()->user()
                ->favoriteReviews()
                ->pluck('review_favorites.review_id')
                ->all();
        }

        return view('reviews.index', compact('reviews', 'favoriteReviewIds'));
    }

    /**
     * 新規作成フォーム
     */
    public function create()
    {
        $works = Work::all();

        return view('reviews.create', compact('works'));
    }

    /**
     * レビューを新規投稿
     */
    public function store(StoreReviewRequest $request)
    {
        $validated = $request->validated();

        $review = Review::create([
            'user_id' => auth()->id(),
            'work_id' => $validated['work_id'],
            'title' => $validated['title'],
            'body' => $validated['body'],
            'score' => $validated['score'],
            'is_spoiler' => $validated['is_spoiler'] ?? false,
            'is_published' => true,
        ]);

        return redirect()->route('reviews.show', ['review' => $review->id])
            ->with('status', 'レビューを投稿しました。');
    }

    /**
     * レビュー詳細
     */
    public function show($id)
    {
        $review = Review::with(['user', 'work', 'comments.user'])
            ->withCount('favoredBy')
            ->findOrFail($id);

        $alreadyFavored = auth()->check()
            ? auth()->user()->favoriteReviews()
                ->where('review_favorites.review_id', $review->id)
                ->exists()
            : false;

        return view('reviews.show', compact('review', 'alreadyFavored'));
    }

    /**
     * 編集フォーム
     */
    public function edit($id)
    {
        $review = Review::findOrFail($id);
        $works = Work::all();

        return view('reviews.edit', compact('review', 'works'));
    }

    /**
     * レビュー削除
     */
    public function delete($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        return redirect()->route('reviews.index')
            ->with('status', 'レビューを削除しました');
    }

    /**
     * レビュー更新
     */
    public function update(UpdateReviewRequest $request, $id)
    {
        $validated = $request->validated();

        $review = Review::findOrFail($id);
        $review->update([
            'work_id' => $validated['work_id'],
            'title' => $validated['title'],
            'body' => $validated['body'],
            'score' => $validated['score'],
            'is_spoiler' => $validated['is_spoiler'] ?? false,
        ]);

        return redirect()->route('reviews.show', ['review' => $review->id])
            ->with('status', 'レビューを更新しました。');
    }
}