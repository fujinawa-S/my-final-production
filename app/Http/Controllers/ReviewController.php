<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Routing\Controller;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'work_id' => 'required|exists:works,id',
            'title' => 'required|string|max:100',
            'body' => 'required|string|max:500',
            'score' => 'required|numeric|min:0|max:5',
            'is_spoiler' => 'nullable|boolean',
        ]);

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
        return redirect()->route('works.show', ['workId' => $validated['work_id']])->with('status', 'レビューを投稿しました！');
    }
}
