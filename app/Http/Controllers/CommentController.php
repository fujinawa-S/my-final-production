<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use App\Models\ReviewComment;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'review_id' => 'required|exists:reviews,id',
            'body' => 'required|string|max:300',
        ]);

        ReviewComment::create([
            'user_id' => auth()->id(),
            'review_id' => $validated['review_id'],
            'body' => $validated['body'],
            'is_published' => true,
        ]);
        $review = Review::find($validated['review_id']);

        return redirect()->route('works.show', ['workId' => $review->work_id])->with('status', 'コメントを投稿しました！')->withFragment('review-' . $review->id);
    }
}
