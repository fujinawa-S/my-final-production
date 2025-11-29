<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use Illuminate\Routing\Controller;

class EpisodeFavoriteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Episode $episode)
    {
        auth()->user()->favoriteEpisodes()->syncWithoutDetaching([$episode->id]);

        return back()->with('status', 'エピソードをいいねしました。');
    }

    public function destroy(Episode $episode)
    {
        auth()->user()->favoriteEpisodes()->detach($episode->id);

        return back()->with('status', 'エピソードのいいねを解除しました。');
    }
}
