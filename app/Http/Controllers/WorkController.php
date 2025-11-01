<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Work;
use App\Models\Review;
use Illuminate\Auth\Facades\Auth;
use Illuminate\Routing\Controller;

class WorkController extends Controller
{
    public function index()
    {
        $works = Work::orderBy('title')->paginate(10);
        return view('works.index', compact('works'));
    }
    public function show(int $workId)
    {
        $work = Work::with(['author', 'genre', 'publisher', 'episodes'])
            ->findOrFail($workId); // 作品が見つからなければ404エラー

        $reviews = $work->reviews()
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('works.show', [
            'work' => $work,
            'reviews' => $reviews,
        ]);
    }
}
