<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Routing\Controller;

class ReviewFavoriteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Review $review)
    {
        $user = auth()->user();
        $user->favoriteReviews()->syncWithoutDetaching([$review->id]);

        return back()->with('status', 'レビューをいいねしました。');
    }

    public function destroy(Review $review)
    {
        $user = auth()->user();
        $user->favoriteReviews()->detach($review->id);

        return back()->with('status', 'いいねを解除しました。');
    }
}
