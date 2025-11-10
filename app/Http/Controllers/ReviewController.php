<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Work;
use Illuminate\Routing\Controller;
use App\Http\Requests\StoreReviewRequest;

class ReviewController extends Controller
{
    /**
     * 一覧表示
     */
    public function index()
    {
        // 投稿を新しい順に取得（User・Workも一緒に）
        $reviews = Review::with(['user', 'work'])->latest()->get();

        return view('reviews.index', compact('reviews'));
    }

    /**
     * 新規作成フォーム表示
     */
    public function create()
    {
        // 投稿対象の作品一覧を取得（プルダウン用）
        $works = Work::all();

        return view('reviews.create', compact('works'));
    }

    /**
     * 新規投稿処理
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

        // 投稿後、詳細ページへリダイレクト
        return redirect()->route('reviews.show', ['review' => $review->id])
            ->with('status', 'レビューを投稿しました！');
    }

    /**
     * 詳細表示
     */
    public function show($id)
    {
        $review = Review::with(['user', 'work'])->findOrFail($id);
        return view('reviews.show', compact('review'));
    }

    /**
     * 編集フォーム表示
     */
    public function edit($id)
    {
        $review = Review::findOrFail($id);
        $works = Work::all();

        return view('reviews.edit', compact('review', 'works'));
    }

    /**
     * 削除処理
     */
    public function delete($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        return redirect()->route('reviews.index')
            ->with('status', 'レビューを削除しました');
    }
    /**
     * 更新処理
     */
    public function update(StoreReviewRequest $request, $id)
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
            ->with('status', 'レビューを更新しました！');
    }
};
