<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEpisodeRequest;
use App\Http\Requests\UpdateEpisodeRequest;
use App\Models\Episode;
use App\Models\Work;
use Illuminate\Routing\Controller;

class EpisodeController extends Controller
{
    public function index()
    {
        $episodes = Episode::with('work')
            ->withCount('favoredByUsers')
            ->latest()
            ->get();

        $favoriteEpisodeIds = [];
        if (auth()->check()) {
            $favoriteEpisodeIds = auth()->user()
                ->favoriteEpisodes()
                ->pluck('episode_favorites.episode_id')
                ->all();
        }

        return view('episodes.index', compact('episodes', 'favoriteEpisodeIds'));
    }

    public function create()
    {
        $works = Work::all();

        return view('episodes.create', compact('works'));
    }

    public function store(StoreEpisodeRequest $request)
    {
        $episode = Episode::create($request->validated());

        return redirect()->route('episodes.show', $episode)
            ->with('status', 'エピソードを投稿しました。');
    }

    public function show(Episode $episode)
    {
        $episode->load('work')
            ->loadCount('favoredByUsers');

        $alreadyFavored = auth()->check()
            ? auth()->user()
            ->favoriteEpisodes()
            ->where('episode_favorites.episode_id', $episode->id)
            ->exists()
            : false;

        return view('episodes.show', compact('episode', 'alreadyFavored'));
    }

    public function edit(Episode $episode)
    {
        $episode->load('work');
        $works = Work::all();

        return view('episodes.edit', compact('episode', 'works'));
    }

    public function update(UpdateEpisodeRequest $request, Episode $episode)
    {
        $episode->update($request->validated());

        return redirect()->route('episodes.show', $episode)
            ->with('status', 'エピソードを更新しました。');
    }

    public function destroy(Episode $episode)
    {
        $episode->delete();

        return redirect()->route('episodes.index')
            ->with('status', 'エピソードを削除しました。');
    }
}
