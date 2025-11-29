<?php

namespace App\Http\Controllers;

use App\Models\Work;
use Illuminate\Routing\Controller;

class WorkFavoriteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Work $work)
    {
        auth()->user()->favoriteWorks()->syncWithoutDetaching([$work->id]);

        return back()->with('status', '作品をいいねしました。');
    }

    public function destroy(Work $work)
    {
        auth()->user()->favoriteWorks()->detach($work->id);

        return back()->with('status', '作品のいいねを解除しました。');
    }
}
