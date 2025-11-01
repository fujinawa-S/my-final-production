<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;
use App\Models\User;


class UserController extends Controller
{
    public function show()
    {
        $user = Auth::user()->load(['reviews.work', 'comments.review']);

        $reviews = $user->reviews->latest()->get();
        $comments = $user->comments->latest()->get();
        return view('users.show', compact('user', 'reviews', 'comments'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('users.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'body' => 'nullable|string|max:500',
        ]);
        $user = Auth::user();
        $user->update($validated);
        return redirect()->route('users.show')->with('status', 'プロフィールを更新しました！');
    }
}
