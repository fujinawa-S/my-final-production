<?php

namespace App\Http\Controllers;

use App\Models\Work;
use Illuminate\Routing\Controller;

class HomeController extends Controller
{
    public function __invoke()
    {
        $featuredWorks = Work::latest()->take(6)->get();
        $animeWorks = Work::where('is_anime_adapted', true)->latest()->take(10)->get();
        $mangaWorks = Work::where('is_anime_adapted', false)->latest()->take(10)->get();

        return view('home', [
            'featuredWorks' => $featuredWorks,
            'animeWorks' => $animeWorks,
            'mangaWorks' => $mangaWorks,
        ]);
    }
}
