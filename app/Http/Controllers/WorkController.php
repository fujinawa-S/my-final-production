<?php

namespace App\Http\Controllers;

use App\Models\Work;
use Illuminate\Routing\Controller;

class WorkController extends Controller
{
    public function index()
    {
        $works = Work::with(['author', 'genre', 'publisher'])
            ->withCount('favoredByUsers')
            ->latest()
            ->get();

        $favoriteWorkIds = [];
        if (auth()->check()) {
            $favoriteWorkIds = auth()->user()
                ->favoriteWorks()
                ->pluck('work_favorites.work_id')
                ->all();
        }

        return view('works.index', compact('works', 'favoriteWorkIds'));
    }

    public function show(Work $work)
    {
        $work->load(['author', 'genre', 'publisher', 'episodes', 'reviews'])
            ->loadCount('favoredByUsers');

        $alreadyFavored = auth()->check()
            ? auth()->user()->favoriteWorks()
            ->where('work_favorites.work_id', $work->id)
            ->exists()
            : false;

        return view('works.show', compact('work', 'alreadyFavored'));
    }
}
