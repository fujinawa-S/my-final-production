<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Review;
use Illuminate\Routing\Controller;

class CommentController extends Controller
{
    public function store(Request $request, Review $review)
    {
        $validated = $request->validate([
            'body' => ['required', 'string', 'max:500'],
        ]);

        $review->comments()->create([
            'body' => $validated['body'],
            'user_id' => auth()->id(),
        ]);

        return redirect()
            ->route('reviews.show', $review)
            ->with('status', 'コメントを投稿しました');
    }

    public function delete(Review $review, Comment $comment)
    {
        abort_unless($comment->review_id === $review->id, 404);

        if (!auth()->check() || $comment->user_id !== auth()->id()) {
            abort(403);
        }

        $comment->delete();

        return redirect()
            ->route('reviews.show', $review)
            ->with('status', 'コメントを削除しました');
    }
}
